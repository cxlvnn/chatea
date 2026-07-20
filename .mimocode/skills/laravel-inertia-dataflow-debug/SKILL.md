---
name: "laravel-inertia-dataflow-debug"
description: "Use when data doesn't appear in the Vue component after a Laravel action (send, update, delete, redirect). Traces the full path: route → controller → response/redirect → HandleInertiaRequests → Inertia page load → Vue props → reactivity. Systematic root cause identification for data flow failures in Laravel + Inertia apps."
---

# Laravel + Inertia Data Flow Debugging

## When to activate

- Data doesn't appear/update in the UI after a successful backend operation
- "Messages not showing after send", "data not updating", "page shows stale data"
- Redirect happens but the Vue component doesn't re-render with new data
- "Nothing is displayed" despite data existing in the database
- Route model binding errors ("Argument #1 must be of type... given")

## Debugging checklist

Trace the data flow step by step. Check each link in the chain.

### Step 1: Route definition
- Find the route in `routes/web.php` (or `api.php`)
- Verify: correct HTTP method (GET/POST/PUT/PATCH/DELETE)
- Verify: route parameters match controller method signature
- Verify: route name (for `to_route()` calls)
- Check: is there a route collision? Could a different route match this URL?

### Step 2: Controller action
- Read the controller method
- Check: what does it return? (`Inertia::render()`, `redirect()`, `to_route()`, `back()`)
- Check: does it pass the correct data to the response?
- Check: is there a `return` statement? (missing return = null response)
- Check: Form Request validation — does it pass? Check `app/Http/Requests/`

### Step 3: Redirect/Response
- `redirect()->back()` — relies on Referer header, may not work with Inertia XHR
- `to_route('name')` — named route, more explicit
- `Inertia::location()` — forces full page reload (use sparingly)
- `Inertia::render()` — passes props directly to Vue page
- Check: does the redirect URL match where the frontend expects to go?

### Step 4: HandleInertiaRequests middleware
- Read `app/Http/Middleware/HandleInertiaRequests.php`
- Check: what data is shared globally? (`'chats' => ...`, `'user' => ...`)
- Check: is the shared data wrapped in a Resource collection? (`.data` wrapper)
- Check: does the shared data refresh on every request or only on first load?

### Step 5: Inertia page load
- When Inertia follows a redirect, it makes an XHR GET to the target URL
- The target controller's `show()` or `index()` method runs again
- Check: does the `show()` method pass fresh data?
- Check: does it eager-load relationships? (`$chat->load('messages')`)
- Check: does the Resource class include all needed data?

### Step 6: Resource/Transformer
- Read the Resource class (`app/Http/Resources/`)
- Check: what fields are included in the response?
- Check: are relationships loaded? (N+1 query warning)
- Check: is the data wrapped? (`Resource::collection()` returns `{data: [...], links, meta}`)
- Frontend must access `.data` if wrapped

### Step 7: Vue component props
- Read the Vue page component
- Check: how are props received? (`defineProps`, `usePage()`)
- Check: is the data accessed correctly? (`.data` wrapper, nested paths)
- Check: is it reactive? (`ref()`, `computed()`, or plain `const`)
- **Critical**: `const messages = props.chat.data.messages` is NOT reactive — it's a one-time snapshot
- Use `computed(() => props.chat.data.messages)` or `ref()` for reactivity

### Step 8: Reactivity in Vue
- `const x = value` — not reactive, won't update on prop changes
- `const x = ref(value)` — reactive, but won't auto-update when parent prop changes
- `const x = computed(() => props.something)` — reactive and tracks parent changes
- `watchEffect(() => { ... })` — side effects that run when dependencies change
- Check: is the template using `v-for` on a reactive source?

## Common root causes

| Symptom | Likely cause |
|---------|-------------|
| Data exists in DB but not in UI | Missing `return` in controller, or wrong redirect target |
| Data shows on refresh but not after action | Controller `show()` doesn't pass fresh data, or Inertia doesn't re-fetch |
| "Can't access property of undefined" | Props not wrapped correctly, or accessing `.data` on non-collection |
| Messages send but don't appear | Vue component uses `const` instead of `computed` for prop access |
| Delete removes wrong resource | Route collision, or `http.delete()` URL resolves to wrong route |
| Route model binding type error | URL doesn't match route parameter pattern, or wrong HTTP method |
| Stale data after update | No `return redirect()->back()` or `Inertia::reload()` after mutation |

## Rules

- Trace the FULL path before guessing — don't assume it's a frontend issue without checking backend
- Check the Network tab: what HTTP request was actually sent? What response came back?
- Verify before diagnosing — the user has corrected wrong diagnoses before
- When the user says "no code", produce the trace as a written explanation with file paths and line numbers only
