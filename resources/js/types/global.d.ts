import "@inertiajs/core";

declare module "@inertiajs/core" {
    export interface InertiaConfig {
        sharedPageProps: {
            data: Array<{
                chats: Array<{
                    id: number;
                    username: string;
                    initial: string;
                    relationships: { lastMessage: string };
                }>;
            }>;
            appName: string;
        };
        errorValueType: string[];
    }
}
