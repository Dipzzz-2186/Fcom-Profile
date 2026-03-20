document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('[data-client-modal]');
    const list = document.querySelector('[data-client-list]');
    const template = document.querySelector('[data-client-item-template]');
    const modalSlot = document.querySelector('[data-client-modal-slot]');
    const openButton = document.querySelector('[data-open-client-modal]');
    const saveButton = document.querySelector('[data-save-client-modal]');
    const closeButtons = document.querySelectorAll('[data-close-client-modal]');
    const emptyState = document.querySelector('[data-client-empty]');

    if (!modal || !list || !template || !modalSlot || !openButton || !saveButton) {
        return;
    }

    let draftItem = null;

    const refreshEmptyState = () => {
        const items = list.querySelectorAll('.client-admin-item');

        if (emptyState) {
            emptyState.hidden = items.length > 0;
        }
    };

    const renumberItems = () => {
        const items = list.querySelectorAll('.client-admin-item');
        items.forEach((item, index) => {
            const title = item.querySelector('.client-admin-item-head strong');
            if (title) {
                title.textContent = `Client ${index + 1}`;
            }
        });
    };

    const bindLogoEditor = (scope) => {
        const editors = scope.querySelectorAll('.client-logo-editor');

        editors.forEach((editor) => {
            const toggleButton = editor.querySelector('[data-toggle-logo-edit]');
            const inputWrap = editor.querySelector('[data-logo-input-wrap]');
            const fileInput = editor.querySelector('[data-client-logo-input]');
            const preview = editor.querySelector('[data-logo-preview]');
            const placeholder = editor.querySelector('[data-logo-placeholder]');

            if (!toggleButton || !inputWrap || !fileInput || !preview) {
                return;
            }

            toggleButton.addEventListener('click', () => {
                inputWrap.hidden = !inputWrap.hidden;
                if (!inputWrap.hidden) {
                    fileInput.focus();
                }
            });

            fileInput.addEventListener('change', () => {
                const file = fileInput.files && fileInput.files[0];

                if (!file) {
                    return;
                }

                const previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.hidden = false;
                if (placeholder) {
                    placeholder.hidden = true;
                }
            });
        });
    };

    const createDraftItem = () => {
        const fragment = template.content.cloneNode(true);
        draftItem = fragment.firstElementChild;
        modalSlot.replaceChildren(draftItem);
        bindLogoEditor(modalSlot);
    };

    const openModal = () => {
        createDraftItem();
        modal.hidden = false;
    };

    const closeModal = () => {
        modal.hidden = true;
        modalSlot.replaceChildren();
        draftItem = null;
    };

    const addDraftToList = () => {
        if (!draftItem) {
            return;
        }

        list.appendChild(draftItem);
        renumberItems();
        refreshEmptyState();
        closeModal();
    };

    openButton.addEventListener('click', openModal);
    saveButton.addEventListener('click', addDraftToList);

    closeButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (!(target instanceof HTMLElement)) {
            return;
        }

        if (target.matches('[data-remove-client]')) {
            const item = target.closest('.client-admin-item');
            item?.remove();
            renumberItems();
            refreshEmptyState();
        }
    });

    bindLogoEditor(document);
    refreshEmptyState();
    renumberItems();
});
