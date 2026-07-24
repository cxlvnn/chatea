import type { InjectionKey, Ref } from "vue";

export const onlineUsersIdSetKey: InjectionKey<Ref<Set<number>>> =
    Symbol("onlineUsersIdSet");
