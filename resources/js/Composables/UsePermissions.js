import { usePage } from '@inertiajs/vue3';

export function usePermissions() {
    const hasPermission = (name) => usePage().props.auth.permissions[name];
    const isSuperAdmin = () => usePage().props.auth.isSuperAdmin;
    const can = () => isSuperAdmin || hasPermission;
    return {
        hasPermission,
        isSuperAdmin,
        can,
    };
}
