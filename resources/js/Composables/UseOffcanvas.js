import { Offcanvas } from 'bootstrap';

export function useOffcanvas(id) {
    return new Offcanvas(id, {
        backdrop: true,
        scroll: false,
        keyboard: true,
    });
}
