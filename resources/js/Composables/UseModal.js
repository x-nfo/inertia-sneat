import { Modal } from 'bootstrap';

export function useModal(modalId) {
    return new Modal(modalId, {
        backdrop: true,
        keyboard: true,
        focus: true,
    });
}
