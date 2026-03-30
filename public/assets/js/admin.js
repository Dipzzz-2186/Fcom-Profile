document.addEventListener('DOMContentLoaded', () => {
    const bindLogoEditor = (scope) => {
        const editors = scope.querySelectorAll('.client-logo-editor');

        editors.forEach((editor) => {
            const toggleButton = editor.querySelector('[data-toggle-logo-edit]');
            const inputWrap = editor.querySelector('[data-logo-input-wrap]');
            const fileInput = editor.querySelector('[data-client-logo-input]');
            const preview = editor.querySelector('[data-logo-preview]');
            const placeholder = editor.querySelector('[data-logo-placeholder]');

            if (!toggleButton || !inputWrap || !fileInput || !preview || editor.dataset.bound === 'true') {
                return;
            }

            editor.dataset.bound = 'true';

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

    const bindBlogImageEditor = (scope) => {
        const inputs = scope.querySelectorAll('[data-blog-image-input]');

        inputs.forEach((input) => {
            if (!(input instanceof HTMLInputElement) || input.dataset.bound === 'true') {
                return;
            }

            input.dataset.bound = 'true';

            input.addEventListener('change', () => {
                const wrapper = input.closest('.blog-image-editor');
                const preview = wrapper?.querySelector('[data-blog-preview]');
                const placeholder = wrapper?.querySelector('[data-blog-placeholder]');
                const file = input.files && input.files[0];

                if (!(preview instanceof HTMLImageElement) || !file) {
                    return;
                }

                const previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.hidden = false;

                if (placeholder instanceof HTMLElement) {
                    placeholder.hidden = true;
                }
            });
        });
    };

    const initClientModal = () => {
        const modal = document.querySelector('[data-client-modal]');
        const list = document.querySelector('[data-client-list]');
        const template = document.querySelector('[data-client-item-template]');
        const modalSlot = document.querySelector('[data-client-modal-slot]');
        const openButton = document.querySelector('[data-open-client-modal]');
        const saveButton = document.querySelector('[data-save-client-modal]');
        const closeButtons = document.querySelectorAll('[data-close-client-modal]');
        const emptyState = document.querySelector('[data-client-empty]');
        const form = list?.closest('form');

        if (!modal || !list || !template || !modalSlot || !openButton || !saveButton || !form) {
            return;
        }

        let draftItem = null;

        const refreshEmptyState = () => {
            const items = Array.from(list.querySelectorAll('[data-client-item]')).filter((item) => !item.hidden);

            if (emptyState) {
                emptyState.hidden = items.length > 0;
            }
        };

        const renumberItems = () => {};

        const bindClientCard = (scope) => {
            scope.querySelectorAll('[data-client-item]').forEach((item) => {
                if (!(item instanceof HTMLElement) || item.dataset.bound === 'true') {
                    return;
                }

                item.dataset.bound = 'true';

                const openButton = item.querySelector('[data-open-client-editor]');
                const closeButtons = item.querySelectorAll('[data-close-client-editor]');
                const modal = item.querySelector('[data-client-editor-modal]');
                const nameInput = item.querySelector('[data-client-name-input]');
                const nameOutput = item.querySelector('[data-client-card-title]');
                const cardPreview = item.querySelector('[data-client-card-preview]');

                if (openButton instanceof HTMLElement && modal instanceof HTMLElement) {
                    openButton.addEventListener('click', () => {
                        modal.hidden = false;
                    });

                    modal.addEventListener('click', (event) => {
                        if (event.target === modal) {
                            modal.hidden = true;
                        }
                    });
                }

                closeButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        if (modal instanceof HTMLElement) {
                            modal.hidden = true;
                        }
                    });
                });

                if (nameInput instanceof HTMLInputElement && nameOutput instanceof HTMLElement) {
                    nameInput.addEventListener('input', () => {
                        nameOutput.textContent = nameInput.value.trim() !== '' ? nameInput.value : 'Client tanpa nama';
                    });
                }

                const logoInput = item.querySelector('[data-client-logo-input]');
                const preview = item.querySelector('[data-logo-preview]');

                if (logoInput instanceof HTMLInputElement && cardPreview instanceof HTMLImageElement && preview instanceof HTMLImageElement) {
                    logoInput.addEventListener('change', () => {
                        const file = logoInput.files && logoInput.files[0];

                        if (!file) {
                            return;
                        }

                        const previewUrl = URL.createObjectURL(file);
                        cardPreview.src = previewUrl;
                        cardPreview.hidden = false;
                    });
                }
            });
        };

        const createDraftItem = () => {
            const fragment = template.content.cloneNode(true);
            draftItem = fragment.firstElementChild;
            modalSlot.replaceChildren(draftItem);
            bindLogoEditor(modalSlot);
            bindClientCard(modalSlot);

            const editorModal = draftItem?.querySelector('[data-client-editor-modal]');
            if (editorModal instanceof HTMLElement) {
                editorModal.hidden = false;
            }
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

            const editorModal = draftItem.querySelector('[data-client-editor-modal]');
            if (editorModal instanceof HTMLElement) {
                editorModal.hidden = true;
            }

            list.appendChild(draftItem);
            renumberItems();
            refreshEmptyState();
            closeModal();
            form.requestSubmit();
            bindClientCard(list);
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

            if (!(target instanceof HTMLElement) || !target.matches('[data-remove-client]')) {
                return;
            }

            const item = target.closest('[data-client-item]');
            item?.remove();
            renumberItems();
            refreshEmptyState();
        });

        bindLogoEditor(document);
        bindClientCard(document);
        refreshEmptyState();
        renumberItems();
    };

    const initBlogModal = () => {
        const modal = document.querySelector('[data-blog-modal]');
        const list = document.querySelector('[data-blog-list]');
        const template = document.querySelector('[data-blog-item-template]');
        const modalSlot = document.querySelector('[data-blog-modal-slot]');
        const openButton = document.querySelector('[data-open-blog-modal]');
        const saveButton = document.querySelector('[data-save-blog-modal]');
        const closeButtons = document.querySelectorAll('[data-close-blog-modal]');
        const emptyState = document.querySelector('[data-blog-empty]');
        const form = list?.closest('form');

        if (!modal || !list || !template || !modalSlot || !openButton || !saveButton || !form) {
            return;
        }

        let draftItem = null;

        const refreshEmptyState = () => {
            const items = Array.from(list.querySelectorAll('[data-blog-item]')).filter((item) => !item.hidden);

            if (emptyState) {
                emptyState.hidden = items.length > 0;
            }
        };

        const renumberItems = () => {
            const items = Array.from(list.querySelectorAll('[data-blog-item]')).filter((item) => !item.hidden);

            items.forEach((item, index) => {
                const title = item.querySelector('.client-admin-item-head strong');
                if (title) {
                    title.textContent = `Artikel ${index + 1}`;
                }
            });
        };

        const applyDraftIndexes = (scope) => {
            const nextIndex = list.querySelectorAll('[data-blog-item]').length;
            scope.querySelectorAll('input[name="blog_featured[]"], input[name="blog_popular[]"]').forEach((field) => {
                field.value = String(nextIndex);
            });
        };

        const bindBlogCard = (scope) => {
            scope.querySelectorAll('[data-blog-item]').forEach((item) => {
                if (!(item instanceof HTMLElement) || item.dataset.bound === 'true') {
                    return;
                }

                item.dataset.bound = 'true';

                const openButton = item.querySelector('[data-open-blog-editor]');
                const closeButtons = item.querySelectorAll('[data-close-blog-editor]');
                const modal = item.querySelector('[data-blog-editor-modal]');
                const titleInput = item.querySelector('[data-blog-title-input]');
                const excerptInput = item.querySelector('[data-blog-excerpt-input]');
                const titleOutput = item.querySelector('[data-blog-card-title]');
                const excerptOutput = item.querySelector('[data-blog-card-excerpt]');

                if (openButton instanceof HTMLElement && modal instanceof HTMLElement) {
                    openButton.addEventListener('click', () => {
                        modal.hidden = false;
                    });

                    modal.addEventListener('click', (event) => {
                        if (event.target === modal) {
                            modal.hidden = true;
                        }
                    });
                }

                closeButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        if (modal instanceof HTMLElement) {
                            modal.hidden = true;
                        }
                    });
                });

                if (titleInput instanceof HTMLInputElement && titleOutput instanceof HTMLElement) {
                    titleInput.addEventListener('input', () => {
                        titleOutput.textContent = titleInput.value.trim() !== '' ? titleInput.value : 'Artikel Baru';
                    });
                }

                if (excerptInput instanceof HTMLTextAreaElement && excerptOutput instanceof HTMLElement) {
                    excerptInput.addEventListener('input', () => {
                        excerptOutput.textContent = excerptInput.value.trim() !== '' ? excerptInput.value : 'Artikel belum diisi.';
                    });
                }
            });
        };

        const createDraftItem = () => {
            const fragment = template.content.cloneNode(true);
            draftItem = fragment.firstElementChild;
            if (!(draftItem instanceof HTMLElement)) {
                return;
            }

            applyDraftIndexes(draftItem);
            modalSlot.replaceChildren(draftItem);
            bindBlogImageEditor(modalSlot);
            bindBlogCard(modalSlot);

            const editorModal = draftItem.querySelector('[data-blog-editor-modal]');
            if (editorModal instanceof HTMLElement) {
                editorModal.hidden = false;
            }
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
            if (!(draftItem instanceof HTMLElement)) {
                return;
            }

            const editorModal = draftItem.querySelector('[data-blog-editor-modal]');
            if (editorModal instanceof HTMLElement) {
                editorModal.hidden = true;
            }

            list.appendChild(draftItem);
            renumberItems();
            refreshEmptyState();
            closeModal();
            bindBlogCard(list);
            form.requestSubmit();
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

            if (!(target instanceof HTMLElement) || !target.matches('[data-remove-blog]')) {
                return;
            }

            const item = target.closest('[data-blog-item]');

            if (!(item instanceof HTMLElement)) {
                return;
            }

            const isNewItem = item.dataset.blogIsNew === 'true';

            if (isNewItem) {
                item.remove();
                renumberItems();
                refreshEmptyState();
                return;
            }

            const deleteInput = item.querySelector('[data-blog-delete-input]');

            if (deleteInput instanceof HTMLInputElement) {
                deleteInput.disabled = false;
            }

            item.hidden = true;
            renumberItems();
            refreshEmptyState();
        });

        refreshEmptyState();
        renumberItems();
        bindBlogImageEditor(document);
        bindBlogCard(document);
    };

    initClientModal();
    initBlogModal();
});
