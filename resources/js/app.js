document.documentElement.classList.add('js');

const confirmationDialog = document.querySelector('[data-confirm-dialog]');
const confirmationTitle = confirmationDialog?.querySelector('[data-confirm-dialog-title]');
const confirmationMessage = confirmationDialog?.querySelector('[data-confirm-dialog-message]');
const cancelConfirmationButton = confirmationDialog?.querySelector('[data-confirm-cancel]');
const acceptConfirmationButton = confirmationDialog?.querySelector('[data-confirm-accept]');
let pendingConfirmationForm = null;
let acceptedConfirmationForm = null;

document.querySelectorAll('[data-confirm-submit]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (form === acceptedConfirmationForm) {
            acceptedConfirmationForm = null;

            return;
        }

        if (!confirmationDialog || typeof confirmationDialog.showModal !== 'function') {
            return;
        }

        event.preventDefault();
        pendingConfirmationForm = form;

        if (confirmationTitle) {
            confirmationTitle.textContent = form.dataset.confirmTitle || 'Confirm action';
        }
        if (confirmationMessage) {
            confirmationMessage.textContent = form.dataset.confirmMessage || 'Are you sure you want to continue?';
        }
        if (cancelConfirmationButton) {
            cancelConfirmationButton.textContent = form.dataset.confirmCancelLabel || 'Cancel';
        }
        if (acceptConfirmationButton) {
            acceptConfirmationButton.textContent = form.dataset.confirmAcceptLabel || 'Confirm';
        }

        confirmationDialog.showModal();
    });
});

cancelConfirmationButton?.addEventListener('click', () => {
    pendingConfirmationForm = null;
    confirmationDialog.close();
});

acceptConfirmationButton?.addEventListener('click', () => {
    if (!pendingConfirmationForm) {
        return;
    }

    const form = pendingConfirmationForm;
    pendingConfirmationForm = null;
    acceptedConfirmationForm = form;
    confirmationDialog.close();
    form.requestSubmit();
});

confirmationDialog?.addEventListener('cancel', () => {
    pendingConfirmationForm = null;
});

const revealElements = document.querySelectorAll('.reveal');

if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px',
    });

    revealElements.forEach((element) => revealObserver.observe(element));
} else {
    revealElements.forEach((element) => element.classList.add('is-visible'));
}
