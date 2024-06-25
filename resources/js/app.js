import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";

import.meta.glob(["../img/**"]);

// SCRIPT GESTIONE SLUG

// Funzione per convertire il titolo in uno slug
function stringToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, ""); // Trim spaces
    str = str.toLowerCase();

    // Rimuovi gli accenti
    const from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    const to = "aaaaeeeeiiiioooouuuunc------";
    for (let i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }

    str = str
        .replace(/[^a-z0-9 -]/g, "") // Rimuovi caratteri invalidi
        .replace(/\s+/g, "-") // Sostituisci gli spazi con -
        .replace(/-+/g, "-"); // Combina i trattini multipli

    return str;
}

// Funzione per impostare l'aggiornamento dinamico dello slug
function setupSlugUpdater() {
    const titleInput = document.getElementById("title");
    const slugInput = document.getElementById("slug");

    if (titleInput && slugInput) {
        titleInput.addEventListener("input", function () {
            const slug = stringToSlug(titleInput.value);
            slugInput.value = slug;
        });
    }
}

// Esegui la funzione quando il DOM è completamente caricato
document.addEventListener("DOMContentLoaded", setupSlugUpdater);

// SCRIPT MODALE

// intercetto tutti i pulsanti di cancellazione (uso DOMContentLoaded per eseguire lo script dopo che il DOM è completamente caricato)
document.addEventListener("DOMContentLoaded", (event) => {
    const trashBtns = document.querySelectorAll(".trash-btn");

    if (event) {
        // console.log("il DOM è completamente caricato");

        trashBtns.forEach((catchTrashBtn) => {
            catchTrashBtn.addEventListener("click", function (event) {
                const modal = new bootstrap.Modal(
                    document.getElementById("delete-modal")
                );

                const projectTitle = catchTrashBtn.dataset.projectTitle;
                const projectSlug = catchTrashBtn.dataset.projectSlug;

                document.getElementById(
                    "modal-message"
                ).innerHTML = `Stai per cancellare il progetto <span class="fw-bold text-danger">${projectTitle}</span>, vuoi proseguire?`;

                const confirmBtn = document.getElementById("confirm-delete");
                const deleteForm = document.getElementById("delete-form");

                confirmBtn.addEventListener("click", function () {
                    deleteForm.action = `/admin/projects/${projectSlug}`;
                    deleteForm.submit();
                });

                modal.show();
            });
        });
    }
});

// SCRIPT PREVIEW IMG
document.getElementById("thumb").addEventListener("change", function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById("preview").src = URL.createObjectURL(file);
    }
});
