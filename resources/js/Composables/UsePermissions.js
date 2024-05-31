import { usePage } from '@inertiajs/vue3';

export function usePermissions() {
    const hasPermission = (permissions) => {
        return usePage().props.auth.permissions[permissions] ? true : false;
    };

    const isSuperAdmin = usePage().props.auth.isSuperAdmin;

    const can = (name) => {
        if (isSuperAdmin === true || hasPermission(name) === true) return true;

        return false;
    };

    return {
        hasPermission,
        isSuperAdmin,
        can,
    };
}
