function salinAlamat(targetId, checkbox) {
    const alamatSiswa = document.getElementById("alamat");
    const targetTextarea = document.getElementById(targetId);

    if (!alamatSiswa || !targetTextarea) return;

    if (checkbox.checked) {
        targetTextarea.value = alamatSiswa.value;
        targetTextarea.setAttribute("readonly", true);
        targetTextarea.classList.add("bg-light");
    } else {
        targetTextarea.value = "";
        targetTextarea.removeAttribute("readonly");
        targetTextarea.classList.remove("bg-light");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const alamatSiswa = document.getElementById("alamat");
    const ids = ["alamat_ayah", "alamat_ibu", "alamat_wali"];

    if (alamatSiswa) {
        alamatSiswa.addEventListener("input", function () {
            ids.forEach((id) => {
                const checkbox = document.getElementById(id + "_sama");
                if (checkbox && checkbox.checked) {
                    document.getElementById(id).value = this.value;
                }
            });
        });
    }
});

function resetCheckboxes() {
    const targets = ["alamat_ayah", "alamat_ibu", "alamat_wali"];
    targets.forEach((id) => {
        const checkbox = document.getElementById(id + "_sama");
        const textarea = document.getElementById(id);
        if (checkbox) checkbox.checked = false;
        if (textarea) {
            textarea.removeAttribute("readonly");
            textarea.classList.remove("bg-light");
        }
    });
}
