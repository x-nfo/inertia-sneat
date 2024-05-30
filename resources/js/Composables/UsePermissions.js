import { usePage } from '@inertiajs/vue3';

export function usePermissions(permission) {
    return (
        usePage().props.auth.permissions[permission] ||
        usePage().props.auth.isSuperAdmin
    );
}
