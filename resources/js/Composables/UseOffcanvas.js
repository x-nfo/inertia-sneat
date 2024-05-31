import { Offcanvas } from 'bootstrap';

export function useOffcanvas(id) {
    return new Offcanvas(id, {
        backdrop: true,
        scroll: true,
        keyboard: true,
    });
}
