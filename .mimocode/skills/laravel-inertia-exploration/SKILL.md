---
name: "laravel-inertia-exploration"
description: "Use before modifying any code in a Laravel + Inertia + Vue project. Traces the full data flow from route → controller → request → resource → middleware → Vue component. Produces a structured understanding of what exists, how data moves, and what the current state is. Do NOT skip this when the user says 'understand first' or 'check the project'."
---

# Laravel + Inertia Codebase Exploration

## When to activate

- User says "understand the project", "go through the files", "check the project", "understand first"
- Before making any changes to an unfamiliar or partially-known Laravel + Inertia + Vue codebase
- When resuming work on a project after other agents have modified it
- When debugging a data flow issue (combine with `laravel-inertia-dataflow-debug` skill)

## Exploration checklist

Work through these in order. Report findings before proceeding.

### 1. Project metadata
- Read `composer.json` — Laravel version, installed packages
- Read `package.json` — frontend dependencies (Vue version, Inertia version, UI libraries)
- Read `vite.config.ts` — build entry points, plugins (Inertia, Vue, Reverb)
- Read `.env.example` or `.env` (if accessible) — BROADCAST_DRIVER, REVERB_* vars, database config

### 2. Database layer
- List migrations in `database/migrations/` — understand table structure and relationships
- Read `app/Models/` — each model's relationships, accessors, mutators, casts
- Check for factories and seeders

### 3. Routes
- Read `routes/web.php` — all route definitions, controller mappings, middleware groups
- Read `routes/channels.php` — broadcast channel definitions (if any)
- Read `routes/api.php` — API endpoints (if any)
- Note: route model binding patterns, named routes, middleware assignments

### 4. Controllers
- Read each controller referenced by routes
- Note: what each action returns (Inertia render, redirect, JSON, response)
- Check for Form Request classes in `app/Http/Requests/`
- Check for Resource classes in `app/Http/Resources/`
- Note: eager loading vs lazy loading patterns

### 5. Middleware
- Read `bootstrap/app.php` — registered middleware
- Read `app/Http/Middleware/HandleInertiaRequests.php` — shared data (what props are globally available)
- Note: what data is shared vs page-specific

### 6. Frontend
- Read `resources/js/app.ts` — Inertia bootstrap, Echo setup, global plugins
- Read `resources/js/pages/` — Inertia page components
- Read `resources/js/components/` — shared components
- Read `resources/js/layouts/` — layout components
- Note: how page props are accessed (`usePage()`, `defineProps`, etc.)

### 7. Events and broadcasting (if applicable)
- Read `app/Events/` — event classes
- Read `config/broadcasting.php` — broadcast driver config
- Read `config/reverb.php` — Reverb config (if used)
- Check frontend for Echo/Broadcasting setup

## Output format

After completing the exploration, produce a structured report:

```
## Codebase Understanding Report

### Stack
- Laravel version: X
- Inertia version: X
- Vue version: X
- UI library: X
- Other key packages: X

### Data flow: [feature name]
Route: [method] [path] → [Controller@action]
Controller returns: [Inertia::render | redirect | JSON]
Shared data (HandleInertiaRequests): [list]
Page props: [list]
Vue component: [path] → accesses props via: [usePage | defineProps]

### Key models and relationships
- Model1: hasMany/belongsTo Model2
- ...

### Current state / issues noticed
- [any bugs, inconsistencies, or concerns observed]
```

## Rules

- Do NOT modify any files during exploration — read-only
- Read actual file contents, don't guess from file names
- If a file is large, read it in sections but read the WHOLE thing
- Report findings before suggesting changes
- Be specific: include file paths, line numbers, variable names
