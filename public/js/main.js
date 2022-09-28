//open and close hamburger menu
jQuery(function () {
    var hamburger = jQuery("#hamburger");
    var sidebar = jQuery(".sidebar");

    hamburger.on("click", function () {
        if (sidebar.hasClass("sidebar-active")) {
            // if menu is opened
            //close menu by removing active class
            sidebar.removeClass("sidebar-active");
            //make hamburger shape change
            hamburger.removeClass("fa-times");
            hamburger.addClass("fa-bars");
            //hide text and arrow
            jQuery(".sidebar-item").addClass("hidden");
            jQuery(".sidebar-item").removeClass("inline");
            //hide/close all opened submenues
            jQuery(".aside-item").hide();
            //change all arrows which are up to down
            jQuery(".arrow").removeClass("fa-angle-up");
            jQuery(".arrow").addClass("fa-angle-down");
        } else {
            //open menu
            sidebar.addClass("sidebar-active");
            //make hamburger shape change
            hamburger.addClass("fa-times");
            hamburger.removeClass("fa-bars");
            //show text and arrow
            jQuery(".sidebar-item").removeClass("hidden");
            jQuery(".sidebar-item").addClass("inline");
        }
    });
});

//open close submenu
jQuery(function () {
    var asideArrow = jQuery(".asideArrow");
    asideArrow.on("click", function () {
        //find on which arrow is clicked
        var num = this.id.match(/\d+/)[0];
        //toggle submenu on click
        jQuery("#aside-item_" + num).slideToggle();
        //change arrow on up or down
        if (jQuery("#arrow-collapse_" + num).hasClass("fa-angle-down")) {
            jQuery("#arrow-collapse_" + num).addClass("fa-angle-up");
            jQuery("#arrow-collapse_" + num).removeClass("fa-angle-down");
        } else {
            jQuery("#arrow-collapse_" + num).addClass("fa-angle-down");
            jQuery("#arrow-collapse_" + num).removeClass("fa-angle-up");
        }
    });
});

//when chekbox is cheked button is enabled, otherwise it is disabled
jQuery(function () {
    jQuery(".form-checkbox").click(function () {
        if (jQuery(".form-checkbox:checked").length > 0) {
            jQuery(".disabled-btn").removeAttr("disabled");
        } else {
            jQuery(".disabled-btn").attr("disabled", "disabled");
        }
    });
});

jQuery(document).ready(function () {
    //this will execute on page load(to be more specific when document ready event occurs)
    if (jQuery(".activity-card").length > 6) {
        jQuery(".activity-card:gt(6)").hide();
        jQuery(".activity-showMore").show();
        jQuery(this).text("Prikaži više");
    }

    jQuery(".activity-showMore").on("click", function () {
        //toggle elements with class .ty-compact-list that their index is bigger than 2
        jQuery(".activity-card:gt(6)").toggle();
        //change text of show more element just for demonstration purposes to this demo
        if (jQuery(this).text() == "Prikaži manje") {
            jQuery(this).text("Prikaži više");
        } else {
            jQuery(this).text("Prikaži manje");
        }
    });

    // Form
    jQuery(".forma").submit(function (e) {
        e.preventDefault();
    });

    // Open Modal
    const modal = jQuery(".modal");
    jQuery(".show-modal").on("click", function () {
        modal.removeClass("hidden");
    });
    // Close Modal
    jQuery(".close-modal").on("click", function () {
        modal.addClass("hidden");
    });

    // Vrati Knjigu Modal
    const vratiModal = jQuery(".vrati-modal");
    jQuery(".show-vratiModal").on("click", function () {
        vratiModal.removeClass("hidden");
    });
    // Close Modal
    jQuery(".close-modal").on("click", function () {
        vratiModal.addClass("hidden");
    });

    // Otpisi Knjigu Modal
    const otpisiModal = jQuery(".otpisi-modal");
    jQuery(".show-otpisiModal").on("click", function () {
        otpisiModal.removeClass("hidden");
    });
    // Close Modal
    jQuery(".otpisi-modal").on("click", function () {
        otpisiModal.addClass("hidden");
    });

    // Izbrisi Zapis Modal
    const izbrisiModal = jQuery(".izbrisi-modal");
    jQuery(".show-izbrisiModal").on("click", function () {
        izbrisiModal.removeClass("hidden");
    });
    // Close Modal
    jQuery(".izbrisi-modal").on("click", function () {
        izbrisiModal.addClass("hidden");
    });
});

function AddReadMore() {
    //This limit you can set after how much characters you want to show Read More.
    var carLmt = 1000;
    // Text to show when text is collapsed
    var readMoreTxt = " ... Prikazi vise &#8681;";
    // Text to show when text is expanded
    var readLessTxt = " Prikazi manje &#8657;";

    //Traverse all selectors with this class and manupulate HTML part to show Read More
    jQuery(".addReadMore").each(function () {
        if (jQuery(this).find(".firstSec").length) return;

        var allstr = jQuery(this).text();
        if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd =
                firstSet +
                "<span class='SecSec'>" +
                secdHalf +
                "</span><span class='readMore'  title='Click to Show More'>" +
                readMoreTxt +
                "</span><span class='readLess' title='Click to Show Less'>" +
                readLessTxt +
                "</span>";
            jQuery(this).html(strtoadd);
        }
    });
    //Read More and Read Less Click Event binding
    jQuery(document).on("click", ".readMore,.readLess", function () {
        jQuery(this)
            .closest(".addReadMore")
            .toggleClass("showlesscontent showmorecontent");
    });
}

jQuery(function () {
    //Calling function after Page Load
    AddReadMore();
});

// File upload
function dataFileDnD() {
    return {
        files: [],
        fileDragging: null,
        fileDropping: null,
        humanFileSize(size) {
            const i = Math.floor(Math.log(size) / Math.log(1024));
            return (
                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                " " +
                ["B", "kB", "MB", "GB", "TB"][i]
            );
        },
        remove(index) {
            let files = [...this.files];
            files.splice(index, 1);

            this.files = createFileList(files);
        },
        drop(e) {
            let removed, add;
            let files = [...this.files];

            removed = files.splice(this.fileDragging, 1);
            files.splice(this.fileDropping, 0, ...removed);

            this.files = createFileList(files);

            this.fileDropping = null;
            this.fileDragging = null;
        },
        dragenter(e) {
            let targetElem = e.target.closest("[draggable]");

            this.fileDropping = targetElem.getAttribute("data-index");
        },
        dragstart(e) {
            this.fileDragging = e.target
                .closest("[draggable]")
                .getAttribute("data-index");
            e.dataTransfer.effectAllowed = "move";
        },
        loadFile(file) {
            const preview = document.querySelectorAll(".preview");
            const blobUrl = URL.createObjectURL(file);

            preview.forEach((elem) => {
                elem.onload = () => {
                    URL.revokeObjectURL(elem.src); // free memory
                };
            });

            return blobUrl;
        },
        addFiles(e) {
            const files = createFileList([...this.files], [...e.target.files]);
            this.files = files;
            this.form.formData.files = [...files];
        },
    };
}

// Student image upload
var loadFileStudent = function (event) {
    var imageStudent = document.getElementById("image-output-student");
    imageStudent.style.display = "block";
    imageStudent.src = URL.createObjectURL(event.target.files[0]);
};

// Librarian image upload
var loadFileLibrarian = function (event) {
    var imageStudent = document.getElementById("image-output-librarian");
    imageStudent.style.display = "block";
    imageStudent.src = URL.createObjectURL(event.target.files[0]);
};

// Category icon upload
jQuery("#icon-upload").change(function () {
    jQuery("#icon-output").text(this.files[0].name);
});

function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;
    /*Make a loop that will continue until
  no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
    first, which contains table headers):*/
        for (i = 1; i < rows.length - 1; i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
      one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (x.children.length == 2) {
                if (x.children[1].children.length == 1) {
                    let [firstName, secondName] = [
                        x.children[1].children[0],
                        y.children[1].children[0],
                    ];
                    //check if the two rows should switch place:
                    if (
                        firstName.innerHTML.toLowerCase() >
                        secondName.innerHTML.toLowerCase()
                    ) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    let [firstName1, secondName1] = [
                        x.children[1],
                        y.children[1],
                    ];
                    if (
                        firstName1.innerHTML.toLowerCase() >
                        secondName1.innerHTML.toLowerCase()
                    ) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            } else if (x.children.length == 1) {
                let [firstName2, secondName2] = [x.children[0], y.children[0]];
                if (
                    firstName2.innerHTML.toLowerCase() >
                    secondName2.innerHTML.toLowerCase()
                ) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
//rezervacije promjena statusa
let rezervacije = jQuery(".rezervacije");
rezervacije.on("click", (event) => {
    if (event.target.classList.contains("reservedStatus")) {
        event.target.closest(".changeStatus").classList.add("hidden");
        event.target
            .closest(".changeStatus")
            .nextElementSibling.classList.remove("hidden");
        event.target
            .closest(".changeStatus")
            .nextElementSibling.nextElementSibling.nextElementSibling.children[0].classList.remove(
                "hidden"
            );
        event.target.closest(".changeBg").classList.remove("bg-gray-200");
    }
    if (event.target.classList.contains("deniedStatus")) {
        event.target.closest(".changeStatus").classList.add("hidden");
        event.target
            .closest(".changeStatus")
            .nextElementSibling.nextElementSibling.classList.remove("hidden");
        event.target
            .closest(".changeStatus")
            .nextElementSibling.nextElementSibling.nextElementSibling.children[0].classList.remove(
                "hidden"
            );
        event.target.closest(".changeBg").classList.remove("bg-gray-200");
    }
});
//ucenikEvidencija, evidencijaIznajmljivanja - funkcija promjene statusa
jQuery(".reservedBook").click(function () {
    var checkMark = jQuery(this);
    var changeColorStatus = checkMark.closest("tr").find(".borderColor");
    var changeTextStatus = checkMark.closest("tr").find(".borderText");
    changeColorStatus.removeClass("border-yellow-500");
    changeColorStatus.removeClass("bg-transparent");
    changeColorStatus.addClass("bg-yellow-200");
    changeTextStatus.text("Potvrdjene rezervacije");
    changeTextStatus.removeClass("text-yellow-500");
    changeTextStatus.addClass("text-yellow-700");
    checkMark.parent().addClass("hidden");
    checkMark.parent().next().removeClass("hidden");
    var backgroundRowChange = checkMark.closest("tr");
    backgroundRowChange.removeClass("bg-gray-200");
});

jQuery(".deniedBook").click(function () {
    var checkMark = jQuery(this);
    var changeColorStatus = checkMark.closest("tr").find(".borderColor");
    var changeTextStatus = checkMark.closest("tr").find(".borderText");
    changeColorStatus.removeClass("border-yellow-500");
    changeColorStatus.removeClass("bg-transparent");
    changeColorStatus.addClass("bg-red-200");
    changeTextStatus.text("Odbijene rezervacije");
    changeTextStatus.removeClass("text-yellow-500");
    changeTextStatus.addClass("text-red-800");
    checkMark.parent().addClass("hidden");
    checkMark.parent().next().removeClass("hidden");
    var backgroundRowChange = checkMark.closest("tr");
    backgroundRowChange.removeClass("bg-gray-200");
});

// Form validation for new librarian
function validacijaBibliotekar() {
    jQuery("#validateNameBibliotekar").empty();
    jQuery("#validateJmbgBibliotekar").empty();
    jQuery("#validateEmailBibliotekar").empty();
    jQuery("#validateUsernameBibliotekar").empty();
    jQuery("#validatePwBibliotekar").empty();
    jQuery("#validatePw2Bibliotekar").empty();

    let nameBibliotekar = jQuery("#imePrezimeBibliotekar").val();
    let jmbgBibliotekar = jQuery("#jmbgBibliotekar").val();
    let emailBibliotekar = jQuery("#emailBibliotekar").val();
    let usernameBibliotekar = jQuery("#usernameBibliotekar").val();
    let pwBibliotekar = jQuery("#pwBibliotekar").val();
    let pw2Bibliotekar = jQuery("#pw2Bibliotekar").val();

    if (nameBibliotekar.length == 0) {
        jQuery("#validateNameBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime!</p>'
        );
    }

    if (jmbgBibliotekar.length == 0) {
        jQuery("#validateJmbgBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti JMBG!</p>'
        );
    }

    if (emailBibliotekar.length == 0) {
        jQuery("#validateEmailBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti validnu e-mail adresu!</p>'
        );
    }

    if (usernameBibliotekar.length == 0) {
        jQuery("#validateUsernameBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti korisnicko ime!</p>'
        );
    }

    if (pwBibliotekar.length == 0) {
        jQuery("#validatePwBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2Bibliotekar.length == 0) {
        jQuery("#validatePw2Bibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsNameBibliotekar() {
    jQuery("#validateNameBibliotekar").empty();
}

function clearErrorsJmbgBibliotekar() {
    jQuery("#validateJmbgBibliotekar").empty();
}

function clearErrorsEmailBibliotekar() {
    jQuery("#validateEmailBibliotekar").empty();
}

function clearErrorsUsernameBibliotekar() {
    jQuery("#validateUsernameBibliotekar").empty();
}

function clearErrorsPwBibliotekar() {
    jQuery("#validatePwBibliotekar").empty();
}

function clearErrorsPw2Bibliotekar() {
    jQuery("#validatePw2Bibliotekar").empty();
}

jQuery("#sacuvajBibliotekara").keypress(function (e) {
    if (e.which == 13) {
        validacijaBibliotekar();
        return false;
    }
});

// Form validation for editing librarian info
function validacijaBibliotekarEdit() {
    jQuery("#validateNameBibliotekarEdit").empty();
    jQuery("#validateJmbgBibliotekarEdit").empty();
    jQuery("#validateEmailBibliotekarEdit").empty();
    jQuery("#validateUsernameBibliotekarEdit").empty();
    jQuery("#validatePwBibliotekarEdit").empty();
    jQuery("#validatePw2BibliotekarEdit").empty();

    let nameBibliotekarEdit = jQuery("#imePrezimeBibliotekarEdit").val();
    let jmbgBibliotekarEdit = jQuery("#jmbgBibliotekarEdit").val();
    let emailBibliotekarEdit = jQuery("#emailBibliotekarEdit").val();
    let usernameBibliotekarEdit = jQuery("#usernameBibliotekarEdit").val();
    let pwBibliotekarEdit = jQuery("#pwBibliotekarEdit").val();
    let pw2BibliotekarEdit = jQuery("#pw2BibliotekarEdit").val();

    if (nameBibliotekarEdit.length == 0) {
        jQuery("#validateNameBibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime!</p>'
        );
    }

    if (jmbgBibliotekarEdit.length == 0) {
        jQuery("#validateJmbgBibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti JMBG!</p>'
        );
    }

    if (emailBibliotekarEdit.length == 0) {
        jQuery("#validateEmailBibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti validnu e-mail adresu!</p>'
        );
    }

    if (usernameBibliotekarEdit.length == 0) {
        jQuery("#validateUsernameBibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti korisnicko ime!</p>'
        );
    }

    if (pwBibliotekarEdit.length == 0) {
        jQuery("#validatePwBibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2BibliotekarEdit.length == 0) {
        jQuery("#validatePw2BibliotekarEdit").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsNameBibliotekarEdit() {
    jQuery("#validateNameBibliotekarEdit").empty();
}

function clearErrorsJmbgBibliotekarEdit() {
    jQuery("#validateJmbgBibliotekarEdit").empty();
}

function clearErrorsEmailBibliotekarEdit() {
    jQuery("#validateEmailBibliotekarEdit").empty();
}

function clearErrorsUsernameBibliotekarEdit() {
    jQuery("#validateUsernameBibliotekarEdit").empty();
}

function clearErrorsPwBibliotekarEdit() {
    jQuery("#validatePwBibliotekarEdit").empty();
}

function clearErrorsPw2BibliotekarEdit() {
    jQuery("#validatePw2BibliotekarEdit").empty();
}

jQuery("#sacuvajBibliotekaraEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaBibliotekarEdit();
        return false;
    }
});

// Form validation for new student
function validacijaUcenik() {
    jQuery("#validateNameUcenik").empty();
    jQuery("#validateJmbgUcenik").empty();
    jQuery("#validateEmailUcenik").empty();
    jQuery("#validateUsernameUcenik").empty();
    jQuery("#validatePwUcenik").empty();
    jQuery("#validatePw2Ucenik").empty();

    let nameUcenik = jQuery("#imePrezimeUcenik").val();
    let jmbgUcenik = jQuery("#jmbgUcenik").val();
    let emailUcenik = jQuery("#emailUcenik").val();
    let usernameUcenik = jQuery("#usernameUcenik").val();
    let pwUcenik = jQuery("#pwUcenik").val();
    let pw2Ucenik = jQuery("#pw2Ucenik").val();

    if (nameUcenik.length == 0) {
        jQuery("#validateNameUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime!</p>'
        );
    }

    if (jmbgUcenik.length == 0) {
        jQuery("#validateJmbgUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti JMBG!</p>'
        );
    }

    if (emailUcenik.length == 0) {
        jQuery("#validateEmailUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti validnu e-mail adresu!</p>'
        );
    }

    if (usernameUcenik.length == 0) {
        jQuery("#validateUsernameUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti korisnicko ime!</p>'
        );
    }

    if (pwUcenik.length == 0) {
        jQuery("#validatePwUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2Ucenik.length == 0) {
        jQuery("#validatePw2Ucenik").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsNameUcenik() {
    jQuery("#validateNameUcenik").empty();
}

function clearErrorsJmbgUcenik() {
    jQuery("#validateJmbgUcenik").empty();
}

function clearErrorsEmailUcenik() {
    jQuery("#validateEmailUcenik").empty();
}

function clearErrorsUsernameUcenik() {
    jQuery("#validateUsernameUcenik").empty();
}

function clearErrorsPwUcenik() {
    jQuery("#validatePwUcenik").empty();
}

function clearErrorsPw2Ucenik() {
    jQuery("#validatePw2Ucenik").empty();
}

jQuery("#sacuvajUcenika").keypress(function (e) {
    if (e.which == 13) {
        validacijaUcenik();
        return false;
    }
});

// Form validation for editing student info
function validacijaUcenikEdit() {
    jQuery("#validateNameUcenikEdit").empty();
    jQuery("#validateJmbgUcenikEdit").empty();
    jQuery("#validateEmailUcenikEdit").empty();
    jQuery("#validateUsernameUcenikEdit").empty();
    jQuery("#validatePwUcenikEdit").empty();
    jQuery("#validatePw2UcenikEdit").empty();

    let nameUcenikEdit = jQuery("#imePrezimeUcenikEdit").val();
    let jmbgUcenikEdit = jQuery("#jmbgUcenikEdit").val();
    let emailUcenikEdit = jQuery("#emailUcenikEdit").val();
    let usernameUcenikEdit = jQuery("#usernameUcenikEdit").val();
    let pwUcenikEdit = jQuery("#pwUcenikEdit").val();
    let pw2UcenikEdit = jQuery("#pw2UcenikEdit").val();

    if (nameUcenikEdit.length == 0) {
        jQuery("#validateNameUcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime!</p>'
        );
    }

    if (jmbgUcenikEdit.length == 0) {
        jQuery("#validateJmbgUcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti JMBG!</p>'
        );
    }

    if (emailUcenikEdit.length == 0) {
        jQuery("#validateEmailUcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti validnu e-mail adresu!</p>'
        );
    }

    if (usernameUcenikEdit.length == 0) {
        jQuery("#validateUsernameUcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti korisnicko ime!</p>'
        );
    }

    if (pwUcenikEdit.length == 0) {
        jQuery("#validatePwUcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2UcenikEdit.length == 0) {
        jQuery("#validatePw2UcenikEdit").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsNameUcenikEdit() {
    jQuery("#validateNameUcenikEdit").empty();
}

function clearErrorsJmbgUcenikEdit() {
    jQuery("#validateJmbgUcenikEdit").empty();
}

function clearErrorsEmailUcenikEdit() {
    jQuery("#validateEmailUcenikEdit").empty();
}

function clearErrorsUsernameUcenikEdit() {
    jQuery("#validateUsernameUcenikEdit").empty();
}

function clearErrorsPwUcenikEdit() {
    jQuery("#validatePwUcenikEdit").empty();
}

function clearErrorsPw2UcenikEdit() {
    jQuery("#validatePw2UcenikEdit").empty();
}

jQuery("#sacuvajUcenikaEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaUcenikEdit();
        return false;
    }
});

// Form validation for new book
function validacijaKnjiga() {
    jQuery("#validateNazivKnjiga").empty();
    jQuery("#validateKategorija").empty();
    jQuery("#validateZanr").empty();
    jQuery("#validateAutori").empty();
    jQuery("#validateIzdavac").empty();
    jQuery("#validateGodinaIzdavanja").empty();
    jQuery("#validateKnjigaKolicina").empty();

    let nazivKnjiga = jQuery("#nazivKnjiga").val();
    let kategorija = jQuery("#kategorijaInput").val();
    let zanr = jQuery("#zanroviInput").val();
    let autori = jQuery("#autoriInput").val();
    let izdavac = jQuery("#izdavac").val();
    let godinaIzdavanja = jQuery("#godinaIzdavanja").val();
    let knjigaKolicina = jQuery("#knjigaKolicina").val();

    if (nazivKnjiga.length == 0) {
        jQuery("#validateNazivKnjiga").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv knjige!</p>'
        );
    }

    if (kategorija.length == 0) {
        jQuery("#validateKategorija").append(
            '<p style="color:red;font-size:13px;">Morate selektovati kategoriju!</p>'
        );
    }

    if (zanr.length == 0) {
        jQuery("#validateZanr").append(
            '<p style="color:red;font-size:13px;">Morate selektovati zanr!</p>'
        );
    }

    if (autori.length == 0) {
        jQuery("#validateAutori").append(
            '<p style="color:red;font-size:13px;">Morate odabrati autore!</p>'
        );
    }

    if (izdavac == null) {
        jQuery("#validateIzdavac").append(
            '<p style="color:red;font-size:13px;">Morate selektovati izdavaca!</p>'
        );
    }

    if (godinaIzdavanja == null) {
        jQuery("#validateGodinaIzdavanja").append(
            '<p style="color:red;font-size:13px;">Morate selektovati godinu izdavanja!</p>'
        );
    }

    if (knjigaKolicina.length == 0) {
        jQuery("#validateKnjigaKolicina").append(
            '<p style="color:red;font-size:13px;">Morate unijeti kolicinu!</p>'
        );
    }
}

function clearErrorsNazivKnjiga() {
    jQuery("#validateNazivKnjiga").empty();
}

function clearErrorsKategorija() {
    jQuery("#validateKategorija").empty();
}

function clearErrorsZanr() {
    jQuery("#validateZanr").empty();
}

function clearErrorsAutori() {
    jQuery("#validateAutori").empty();
}

function clearErrorsIzdavac() {
    jQuery("#validateIzdavac").empty();
}

function clearErrorsGodinaIzdavanja() {
    jQuery("#validateGodinaIzdavanja").empty();
}

function clearErrorsKnjigaKolicina() {
    jQuery("#validateKnjigaKolicina").empty();
}

jQuery("#sacuvajKnjigu").keypress(function (e) {
    if (e.which == 13) {
        validacijaKnjiga();
        return false;
    }
});

// Form validation for editing book info
function validacijaKnjigaEdit() {
    jQuery("#validateNazivKnjigaEdit").empty();
    jQuery("#validateKategorijaEdit").empty();
    jQuery("#validateZanrEdit").empty();
    jQuery("#validateAutoriEdit").empty();
    jQuery("#validateIzdavacEdit").empty();
    jQuery("#validateGodinaIzdavanjaEdit").empty();
    jQuery("#validateKnjigaKolicinaEdit").empty();

    let nazivKnjigaEdit = jQuery("#nazivKnjigaEdit").val();
    let kategorijaInputEdit = jQuery("#kategorijaInputEdit").val();
    let zanroviInputEdit = jQuery("#zanroviInputEdit").val();
    let autoriInputEdit = jQuery("#autoriInputEdit").val();
    let izdavacEdit = jQuery("#izdavacEdit").val();
    let godinaIzdavanjaEdit = jQuery("#godinaIzdavanjaEdit").val();
    let knjigaKolicinaEdit = jQuery("#knjigaKolicinaEdit").val();

    if (nazivKnjigaEdit.length == 0) {
        jQuery("#validateNazivKnjigaEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv knjige!</p>'
        );
    }

    if (kategorijaInputEdit.length == 0) {
        jQuery("#validateKategorijaEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati kategoriju!</p>'
        );
    }

    if (zanroviInputEdit.length == 0) {
        jQuery("#validateZanrEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati zanr!</p>'
        );
    }

    if (autoriInputEdit.length == 0) {
        jQuery("#validateAutoriEdit").append(
            '<p style="color:red;font-size:13px;">Morate odabrati autore!</p>'
        );
    }

    if (izdavacEdit == null) {
        jQuery("#validateIzdavacEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati izdavaca!</p>'
        );
    }

    if (godinaIzdavanjaEdit == null) {
        jQuery("#validateGodinaIzdavanjaEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati godinu izdavanja!</p>'
        );
    }

    if (knjigaKolicinaEdit.length == 0) {
        jQuery("#validateKnjigaKolicinaEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti kolicinu!</p>'
        );
    }
}

function clearErrorsNazivKnjigaEdit() {
    jQuery("#validateNazivKnjigaEdit").empty();
}

function clearErrorsKategorijaEdit() {
    jQuery("#validateKategorijaEdit").empty();
}

function clearErrorsZanrEdit() {
    jQuery("#validateZanrEdit").empty();
}

function clearErrorsAutoriEdit() {
    jQuery("#validateAutoriEdit").empty();
}

function clearErrorsIzdavacEdit() {
    jQuery("#validateIzdavacEdit").empty();
}

function clearErrorsGodinaIzdavanjaEdit() {
    jQuery("#validateGodinaIzdavanjaEdit").empty();
}

function clearErrorsKnjigaKolicinaEdit() {
    jQuery("#validateKnjigaKolicinaEdit").empty();
}

jQuery("#sacuvajKnjiguEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaKnjigaEdit();
        return false;
    }
});

// Form validation for new specification of the book
function validacijaSpecifikacija() {
    jQuery("#validateBrStrana").empty();
    jQuery("#validatePismo").empty();
    jQuery("#validatePovez").empty();
    jQuery("#validateFormat").empty();
    jQuery("#validateIsbn").empty();

    let brStrana = jQuery("#brStrana").val();
    let pismo = jQuery("#pismo").val();
    let povez = jQuery("#povez").val();
    let format = jQuery("#format").val();
    let isbn = jQuery("#isbn").val();

    if (brStrana.length == 0) {
        jQuery("#validateBrStrana").append(
            '<p style="color:red;font-size:13px;">Morate unijeti broj strana!</p>'
        );
    }

    if (pismo == null) {
        jQuery("#validatePismo").append(
            '<p style="color:red;font-size:13px;">Morate selektovati pismo!</p>'
        );
    }

    if (povez == null) {
        jQuery("#validatePovez").append(
            '<p style="color:red;font-size:13px;">Morate selektovati povez!</p>'
        );
    }

    if (format == null) {
        jQuery("#validateFormat").append(
            '<p style="color:red;font-size:13px;">Morate selektovati format!</p>'
        );
    }

    if (isbn.length == 0) {
        jQuery("#validateIsbn").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ISBN!</p>'
        );
    }
}

function clearErrorsBrStrana() {
    jQuery("#validateBrStrana").empty();
}

function clearErrorsPismo() {
    jQuery("#validatePismo").empty();
}

function clearErrorsPovez() {
    jQuery("#validatePovez").empty();
}

function clearErrorsFormat() {
    jQuery("#validateFormat").empty();
}

function clearErrorsIsbn() {
    jQuery("#validateIsbn").empty();
}

jQuery("#sacuvajSpecifikaciju").keypress(function (e) {
    if (e.which == 13) {
        validacijaSpecifikacija();
        return false;
    }
});

// Form validation for editing specification of the book
function validacijaSpecifikacijaEdit() {
    jQuery("#validateBrStranaEdit").empty();
    jQuery("#validatePismoEdit").empty();
    jQuery("#validatePovezEdit").empty();
    jQuery("#validateFormatEdit").empty();
    jQuery("#validateIsbnEdit").empty();

    let brStranaEdit = jQuery("#brStranaEdit").val();
    let pismoEdit = jQuery("#pismoEdit").val();
    let povezEdit = jQuery("#povezEdit").val();
    let formatEdit = jQuery("#formatEdit").val();
    let isbnEdit = jQuery("#isbnEdit").val();

    if (brStranaEdit.length == 0) {
        jQuery("#validateBrStranaEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti broj strana!</p>'
        );
    }

    if (pismoEdit == null) {
        jQuery("#validatePismoEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati pismo!</p>'
        );
    }

    if (povezEdit == null) {
        jQuery("#validatePovezEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati povez!</p>'
        );
    }

    if (formatEdit == null) {
        jQuery("#validateFormatEdit").append(
            '<p style="color:red;font-size:13px;">Morate selektovati format!</p>'
        );
    }

    if (isbnEdit.length == 0) {
        jQuery("#validateIsbnEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ISBN!</p>'
        );
    }
}

function clearErrorsBrStranaEdit() {
    jQuery("#validateBrStranaEdit").empty();
}

function clearErrorsPismoEdit() {
    jQuery("#validatePismoEdit").empty();
}

function clearErrorsPovezEdit() {
    jQuery("#validatePovezEdit").empty();
}

function clearErrorsFormatEdit() {
    jQuery("#validateFormatEdit").empty();
}

function clearErrorsIsbnEdit() {
    jQuery("#validateIsbnEdit").empty();
}

jQuery("#sacuvajSpecifikacijuEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaSpecifikacijaEdit();
        return false;
    }
});

// Form validation for renting books
function validacijaIzdavanje() {
    jQuery("#validateUcenikIzdavanje").empty();
    jQuery("#validateDatumIzdavanja").empty();

    let ucenikIzdavanje = jQuery("#ucenikIzdavanje").val();
    let datumIzdavanja = jQuery("#datumIzdavanja").val();

    if (ucenikIzdavanje == null) {
        jQuery("#validateUcenikIzdavanje").append(
            '<p style="color:red;font-size:13px;">Morate selektovati ucenika!</p>'
        );
    }

    if (datumIzdavanja.length == 0) {
        jQuery("#validateDatumIzdavanja").append(
            '<p style="color:red;font-size:13px;">Morate selektovati datum izdavanja!</p>'
        );
    }
}

function clearErrorsUcenikIzdavanje() {
    jQuery("#validateUcenikIzdavanje").empty();
}

function clearErrorsDatumIzdavanja() {
    jQuery("#validateDatumIzdavanja").empty();
}

jQuery("#izdajKnjigu").keypress(function (e) {
    if (e.which == 13) {
        validacijaIzdavanje();
        return false;
    }
});

// Form validation for making reservations
function validacijaRezervisanje() {
    jQuery("#validateUcenikRezervisanje").empty();
    jQuery("#validateDatumRezervisanja").empty();

    let ucenikRezervisanje = jQuery("#ucenikRezervisanje").val();
    let datumRezervisanja = jQuery("#datumRezervisanja").val();

    if (ucenikRezervisanje == null) {
        jQuery("#validateUcenikRezervisanje").append(
            '<p style="color:red;font-size:13px;">Morate selektovati ucenika!</p>'
        );
    }

    if (datumRezervisanja.length == 0) {
        jQuery("#validateDatumRezervisanja").append(
            '<p style="color:red;font-size:13px;">Morate selektovati datum rezervisanja!</p>'
        );
    }
}

function clearErrorsUcenikRezervisanje() {
    jQuery("#validateUcenikRezervisanje").empty();
}

function clearErrorsDatumRezervisanja() {
    jQuery("#validateDatumRezervisanja").empty();
}

jQuery("#rezervisiKnjigu").keypress(function (e) {
    if (e.which == 13) {
        validacijaRezervisanje();
        return false;
    }
});

// Form validation for new category
function validacijaKategorija() {
    jQuery("#validateNazivKategorije").empty();

    let nazivKategorije = jQuery("#nazivKategorije").val();

    if (nazivKategorije.length == 0) {
        jQuery("#validateNazivKategorije").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv kategorije!</p>'
        );
    }
}

function clearErrorsNazivKategorije() {
    jQuery("#validateNazivKategorije").empty();
}

jQuery("#sacuvajKategoriju").keypress(function (e) {
    if (e.which == 13) {
        validacijaKategorija();
        return false;
    }
});

// Form validation for editing category info
function validacijaKategorijaEdit() {
    jQuery("#validateNazivKategorijeEdit").empty();

    let nazivKategorijeEdit = jQuery("#nazivKategorijeEdit").val();

    if (nazivKategorijeEdit.length == 0) {
        jQuery("#validateNazivKategorijeEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv kategorije!</p>'
        );
    }
}

function clearErrorsNazivKategorijeEdit() {
    jQuery("#validateNazivKategorijeEdit").empty();
}

jQuery("#sacuvajKategorijuEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaKategorijaEdit();
        return false;
    }
});

// Form validation for new author
function validacijaAutor() {
    jQuery("#validateImePrezimeAutor").empty();

    let imePrezimeAutor = jQuery("#imePrezimeAutor").val();

    if (imePrezimeAutor.length == 0) {
        jQuery("#validateImePrezimeAutor").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime autora!</p>'
        );
    }
}

function clearErrorsImePrezimeAutor() {
    jQuery("#validateImePrezimeAutor").empty();
}

jQuery("#sacuvajAutora").keypress(function (e) {
    if (e.which == 13) {
        validacijaAutor();
        return false;
    }
});

// Form validation for editing author info
function validacijaAutorEdit() {
    jQuery("#validateImePrezimeAutorEdit").empty();

    let imePrezimeAutorEdit = jQuery("#imePrezimeAutorEdit").val();

    if (imePrezimeAutorEdit.length == 0) {
        jQuery("#validateImePrezimeAutorEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti ime i prezime autora!</p>'
        );
    }
}

function clearErrorsImePrezimeAutorEdit() {
    jQuery("#validateImePrezimeAutorEdit").empty();
}

jQuery("#sacuvajAutoraEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaAutorEdit();
        return false;
    }
});

// Form validation for new genre
function validacijaZanr() {
    jQuery("#validateNazivZanra").empty();

    let nazivZanra = jQuery("#nazivZanra").val();

    if (nazivZanra.length == 0) {
        jQuery("#validateNazivZanra").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv zanra!</p>'
        );
    }
}

function clearErrorsNazivZanra() {
    jQuery("#validateNazivZanra").empty();
}

jQuery("#sacuvajZanr").keypress(function (e) {
    if (e.which == 13) {
        validacijaZanr();
        return false;
    }
});

// Form validation for editing genre info
function validacijaZanrEdit() {
    jQuery("#validateNazivZanraEdit").empty();

    let nazivZanraEdit = jQuery("#nazivZanraEdit").val();

    if (nazivZanraEdit.length == 0) {
        jQuery("#validateNazivZanraEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv zanra!</p>'
        );
    }
}

function clearErrorsNazivZanraEdit() {
    jQuery("#validateNazivZanraEdit").empty();
}

jQuery("#sacuvajZanrEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaZanrEdit();
        return false;
    }
});

// Form validation for new publisher
function validacijaIzdavac() {
    jQuery("#validateNazivIzdavac").empty();

    let nazivIzdavac = jQuery("#nazivIzdavac").val();

    if (nazivIzdavac.length == 0) {
        jQuery("#validateNazivIzdavac").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv izdavaca!</p>'
        );
    }
}

function clearErrorsNazivIzdavac() {
    jQuery("#validateNazivIzdavac").empty();
}

jQuery("#sacuvajIzdavac").keypress(function (e) {
    if (e.which == 13) {
        validacijaIzdavac();
        return false;
    }
});

// Form validation for editing publisher info
function validacijaIzdavacEdit() {
    jQuery("#validateNazivIzdavacEdit").empty();

    let nazivIzdavacEdit = jQuery("#nazivIzdavacEdit").val();

    if (nazivIzdavacEdit.length == 0) {
        jQuery("#validateNazivIzdavacEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv izdavaca!</p>'
        );
    }
}

function clearErrorsNazivIzdavacEdit() {
    jQuery("#validateNazivIzdavacEdit").empty();
}

jQuery("#sacuvajIzdavacEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaIzdavacEdit();
        return false;
    }
});

// Form validation for new book bind
function validacijaPovez() {
    jQuery("#validateNazivPovez").empty();

    let nazivPovez = jQuery("#nazivPovez").val();

    if (nazivPovez.length == 0) {
        jQuery("#validateNazivPovez").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv poveza!</p>'
        );
    }
}

function clearErrorsNazivPovez() {
    jQuery("#validateNazivPovez").empty();
}

jQuery("#sacuvajPovez").keypress(function (e) {
    if (e.which == 13) {
        validacijaPovez();
        return false;
    }
});

// Form validation for editing book bind info
function validacijaPovezEdit() {
    jQuery("#validateNazivPovezEdit").empty();

    let nazivPovezEdit = jQuery("#nazivPovezEdit").val();

    if (nazivPovezEdit.length == 0) {
        jQuery("#validateNazivPovezEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv poveza!</p>'
        );
    }
}

function clearErrorsNazivPovezEdit() {
    jQuery("#validateNazivPovezEdit").empty();
}

jQuery("#sacuvajPovezEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaPovezEdit();
        return false;
    }
});

// Form validation for new book format
function validacijaFormat() {
    jQuery("#validateNazivFormat").empty();

    let nazivFormat = jQuery("#nazivFormat").val();

    if (nazivFormat.length == 0) {
        jQuery("#validateNazivFormat").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv formata!</p>'
        );
    }
}

function clearErrorsNazivFormat() {
    jQuery("#validateNazivFormat").empty();
}

jQuery("#sacuvajFormat").keypress(function (e) {
    if (e.which == 13) {
        validacijaFormat();
        return false;
    }
});

// Form validation for editing book format info
function validacijaFormatEdit() {
    jQuery("#validateNazivFormatEdit").empty();

    let nazivFormatEdit = jQuery("#nazivFormatEdit").val();

    if (nazivFormatEdit.length == 0) {
        jQuery("#validateNazivFormatEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv formata!</p>'
        );
    }
}

function clearErrorsNazivFormatEdit() {
    jQuery("#validateNazivFormatEdit").empty();
}

jQuery("#sacuvajFormatEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaFormatEdit();
        return false;
    }
});

// Form validation for new book script
function validacijaPismo() {
    jQuery("#validateNazivPismo").empty();

    let nazivPismo = jQuery("#nazivPismo").val();

    if (nazivPismo.length == 0) {
        jQuery("#validateNazivPismo").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv pisma!</p>'
        );
    }
}

function clearErrorsNazivPismo() {
    jQuery("#validateNazivPismo").empty();
}

jQuery("#sacuvajPismo").keypress(function (e) {
    if (e.which == 13) {
        validacijaPismo();
        return false;
    }
});

// Form validation for new book script
function validacijaPismoEdit() {
    jQuery("#validateNazivPismoEdit").empty();

    let nazivPismoEdit = jQuery("#nazivPismoEdit").val();

    if (nazivPismoEdit.length == 0) {
        jQuery("#validateNazivPismoEdit").append(
            '<p style="color:red;font-size:13px;">Morate unijeti naziv pisma!</p>'
        );
    }
}

function clearErrorsNazivPismoEdit() {
    jQuery("#validateNazivPismoEdit").empty();
}

jQuery("#sacuvajPismoEdit").keypress(function (e) {
    if (e.which == 13) {
        validacijaPismoEdit();
        return false;
    }
});

// Form validation for reseting password - student
function validacijaSifraUcenik() {
    jQuery("#validatePwResetUcenik").empty();
    jQuery("#validatePw2ResetUcenik").empty();

    let pwResetUcenik = jQuery("#pwResetUcenik").val();
    let pw2ResetUcenik = jQuery("#pw2ResetUcenik").val();

    if (pwResetUcenik.length == 0) {
        jQuery("#validatePwResetUcenik").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2ResetUcenik.length == 0) {
        jQuery("#validatePw2ResetUcenik").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsPwResetUcenik() {
    jQuery("#validatePwResetUcenik").empty();
}

function clearErrorsPw2ResetUcenik() {
    jQuery("#validatePw2ResetUcenik").empty();
}

jQuery("#resetujSifruUcenik").keypress(function (e) {
    if (e.which == 13) {
        validacijaSifraUcenik();
        return false;
    }
});

// Form validation for reseting password - librarian
function validacijaSifraBibliotekar() {
    jQuery("#validatePwResetBibliotekar").empty();
    jQuery("#validatePw2ResetBibliotekar").empty();

    let pwResetBibliotekar = jQuery("#pwResetBibliotekar").val();
    let pw2ResetBibliotekar = jQuery("#pw2ResetBibliotekar").val();

    if (pwResetBibliotekar.length == 0) {
        jQuery("#validatePwResetBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate unijeti sifru!</p>'
        );
    }

    if (pw2ResetBibliotekar.length == 0) {
        jQuery("#validatePw2ResetBibliotekar").append(
            '<p style="color:red;font-size:13px;">Morate ponoviti sifru!</p>'
        );
    }
}

function clearErrorsPwResetBibliotekar() {
    jQuery("#validatePwResetBibliotekar").empty();
}

function clearErrorsPw2ResetBibliotekar() {
    jQuery("#validatePw2ResetBibliotekar").empty();
}

jQuery("#resetujSifruBibliotekar").keypress(function (e) {
    if (e.which == 13) {
        validacijaSifraBibliotekar();
        return false;
    }
});

function sortTableDate(row) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = jQuery(".sortTableDate");
    switching = true;
    /*Make a loop that will continue until
  no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table[0].rows;
        /*Loop through all table rows (except the
    first, which contains table headers):*/
        for (i = 1; i < rows.length - 1; i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
      one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[row];
            y = rows[i + 1].getElementsByTagName("TD")[row];
            let first = jQuery(x).text().split(".");
            let [d1, m1, y1] = [
                parseInt(first[0]),
                parseInt(first[1]),
                parseInt(first[2]),
            ];
            let second = jQuery(y).text().split(".");
            let [d2, m2, y2] = [
                parseInt(second[0]),
                parseInt(second[1]),
                parseInt(second[2]),
            ];
            //check if the two rows should switch place:
            if (y1 > y2) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            } else if (y1 == y2 && m1 > m2) {
                shouldSwitch = true;
                break;
            } else if (y1 == y2 && m1 == m2 && d1 > d2) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

jQuery("#autoriMenu").on("click", function () {
    jQuery(".autoriMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var autoriMenu = jQuery(".autoriMenu");
    if (
        !autoriMenu.is(e.target) &&
        autoriMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".autoriMenu")
    ) {
        autoriMenu.slideUp();
    }
});

jQuery("#kategorijeMenu").on("click", function () {
    jQuery(".kategorijeMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var kategorijeMenu = jQuery(".kategorijeMenu");
    if (
        !kategorijeMenu.is(e.target) &&
        kategorijeMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".kategorijeMenu")
    ) {
        kategorijeMenu.slideUp();
    }
});

jQuery(".uceniciDrop-toggle").on("click", function () {
    jQuery(".uceniciMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var uceniciMenu = jQuery(".uceniciMenu");
    if (
        !uceniciMenu.is(e.target) &&
        uceniciMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".uceniciMenu")
    ) {
        uceniciMenu.slideUp();
    }
});

jQuery(".bibliotekariDrop-toggle").on("click", function () {
    jQuery(".bibliotekariMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var bibliotekariMenu = jQuery(".bibliotekariMenu");
    if (
        !bibliotekariMenu.is(e.target) &&
        bibliotekariMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".bibliotekariMenu")
    ) {
        bibliotekariMenu.slideUp();
    }
});

jQuery("#knjigeMenu").on("click", function () {
    jQuery(".knjigeMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var knjigeMenu = jQuery(".knjigeMenu");
    if (
        !knjigeMenu.is(e.target) &&
        knjigeMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".knjigeMenu")
    ) {
        knjigeMenu.slideUp();
    }
});

jQuery("#transakcijeMenu").on("click", function () {
    jQuery(".transakcijeMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var transakcijeMenu = jQuery(".transakcijeMenu");
    if (
        !transakcijeMenu.is(e.target) &&
        transakcijeMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".transakcijeMenu")
    ) {
        transakcijeMenu.slideUp();
    }
});

jQuery(".datumDrop-toggle").on("click", function () {
    jQuery(".datumMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var datumMenu = jQuery(".datumMenu");
    if (
        !datumMenu.is(e.target) &&
        datumMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".datumMenu")
    ) {
        datumMenu.slideUp();
    }
});

jQuery(".zadrzavanjeDrop-toggle").on("click", function () {
    jQuery(".zadrzavanjeMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var datumMenu = jQuery(".zadrzavanjeMenu");
    if (
        !datumMenu.is(e.target) &&
        datumMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".zadrzavanjeMenu")
    ) {
        datumMenu.slideUp();
    }
});

jQuery(".vracanjeDrop-toggle").on("click", function () {
    jQuery(".vracanjeMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var vracanjeMenu = jQuery(".vracanjeMenu");
    if (
        !vracanjeMenu.is(e.target) &&
        vracanjeMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".vracanjeMenu")
    ) {
        vracanjeMenu.slideUp();
    }
});

jQuery(".statusDrop-toggle").on("click", function () {
    jQuery(".statusMenu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var statusMenu = jQuery(".statusMenu");
    if (
        !statusMenu.is(e.target) &&
        statusMenu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".statusMenu")
    ) {
        statusMenu.slideUp();
    }
});

function filterFunction(id, dropdown, item) {
    var input, filter, ul, li, a, i;
    console.log(id);
    console.log(dropdown);

    input = document.getElementById(id);
    filter = input.value.toUpperCase();
    div = document.getElementById(dropdown);
    li = document.getElementsByClassName(item);
    text = div.getElementsByTagName("p");

    for (i = 0; i < text.length; i++) {
        txtValue = text[i].textContent || text[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// Multiple select dropdown list - new book
function dropdown() {
    return {
        options: [],
        selected: [],
        show: false,
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        },
        isOpen() {
            return this.show === true;
        },
        select(index, event) {
            if (!this.options[index].selected) {
                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);
            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false;
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);
        },
        loadOptions() {
            const options = document.getElementById("kategorija").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        loadOptionsEdit() {
            const options = document.getElementById("kategorijaEdit").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        loadOptionsZanrovi() {
            const options = document.getElementById("zanr").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        loadOptionsZanroviEdit() {
            const options = document.getElementById("zanrEdit").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        loadOptionsAutori() {
            const options = document.getElementById("autori").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        loadOptionsAutoriEdit() {
            const options = document.getElementById("autoriEdit").options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected:
                        options[i].getAttribute("selected") != null
                            ? options[i].getAttribute("selected")
                            : false,
                });
            }
        },
        selectedValues() {
            return this.selected.map((option) => {
                return this.options[option].value;
            });
        },
        selectedValuesKategorijaEdit() {
            const options = document.getElementById("kategorijaEdit").options;
            return options[1].innerText;
        },
        selectedValuesZanrEdit() {
            const options = document.getElementById("zanrEdit").options;
            return options[2].innerText;
        },
        selectedValuesAutoriEdit() {
            const options = document.getElementById("autoriEdit").options;
            return options[0].innerText;
        },
    };
}

function funkcijaDatumVracanja() {
    var selectedDate = new Date(jQuery("#datumIzdavanja").val());
    var numberOfDaysToAdd = 20;

    selectedDate.setDate(selectedDate.getDate() + numberOfDaysToAdd);

    var day = selectedDate.getDate();
    var month = selectedDate.getMonth() + 1;
    var year = selectedDate.getFullYear();

    var newDate = [day, month, year].join("/");

    document.getElementById("datumVracanja").value = newDate;
}

//click on one and check all checkboxes (vratiKnjigu.php)
jQuery(".select-all").click(function () {
    if (jQuery(this).is(":checked")) {
        jQuery(".form-checkbox").prop("checked", true);
        jQuery("tr").addClass("bg-gray-200");
    } else {
        jQuery(".form-checkbox").prop("checked", false);
        jQuery("tr").removeClass("bg-gray-200");
    }
});

jQuery(".form-checkbox").click(function () {
    if (jQuery(this).is(":checked")) {
        jQuery(this).closest("tr").addClass("bg-gray-200");
    } else {
        jQuery(this).closest("tr").removeClass("bg-gray-200");
    }
});

// Edit book multimedia - delete (hide) image
jQuery("#hide-image1").click(function () {
    jQuery(".hiddenImage1").hide();
});

jQuery("#hide-image2").click(function () {
    jQuery(".hiddenImage2").hide();
});

// Header - dropdown for create button
jQuery("#dropdownCreate").click(function () {
    jQuery(".dropdown-create").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownCreate = jQuery(".dropdown-create");
    if (
        !dropdownCreate.is(e.target) &&
        dropdownCreate.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dropdownCreate")
    ) {
        dropdownCreate.slideUp();
    }
});

// Header - dropdown for profile button
jQuery("#dropdownProfile").click(function () {
    jQuery(".dropdown-profile").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownProfile = jQuery(".dropdown-profile");
    if (
        !dropdownProfile.is(e.target) &&
        dropdownProfile.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dropdownProfile")
    ) {
        dropdownProfile.slideUp();
    }
});

// Category - table - dropdown
jQuery(".dotsCategory").click(function () {
    var dotsCategory = jQuery(this);
    var dropdownCategory = dotsCategory
        .closest("td")
        .find(".dropdown-category");
    dropdownCategory.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownCategory = jQuery(".dropdown-category");
    if (
        !dropdownCategory.is(e.target) &&
        dropdownCategory.has(e.target).length === 0
    ) {
        dropdownCategory.slideUp();
    }
});

// Genre - table - dropdown
jQuery(".dotsGenre").click(function () {
    var dotsGenre = jQuery(this);
    var dropdownGenre = dotsGenre.closest("td").find(".dropdown-genre");
    dropdownGenre.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownGenre = jQuery(".dropdown-genre");
    if (
        !dropdownGenre.is(e.target) &&
        dropdownGenre.has(e.target).length === 0
    ) {
        dropdownGenre.slideUp();
    }
});

// Publisher - table - dropdown
jQuery(".dotsPublisher").click(function () {
    var dotsPublisher = jQuery(this);
    var dropdownPublisher = dotsPublisher
        .closest("td")
        .find(".dropdown-publisher");
    dropdownPublisher.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownPublisher = jQuery(".dropdown-publisher");
    if (
        !dropdownPublisher.is(e.target) &&
        dropdownPublisher.has(e.target).length === 0
    ) {
        dropdownPublisher.slideUp();
    }
});

// Book bind - table - dropdown
jQuery(".dotsBookBind").click(function () {
    var dotsBookBind = jQuery(this);
    var dropdownBookBind = dotsBookBind
        .closest("td")
        .find(".dropdown-book-bind");
    dropdownBookBind.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownBookBind = jQuery(".dropdown-book-bind");
    if (
        !dropdownBookBind.is(e.target) &&
        dropdownBookBind.has(e.target).length === 0
    ) {
        dropdownBookBind.slideUp();
    }
});

// Format - table - dropdown
jQuery(".dotsFormat").click(function () {
    var dotsFormat = jQuery(this);
    var dropdownFormat = dotsFormat.closest("td").find(".dropdown-format");
    dropdownFormat.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownFormat = jQuery(".dropdown-format");
    if (
        !dropdownFormat.is(e.target) &&
        dropdownFormat.has(e.target).length === 0
    ) {
        dropdownFormat.slideUp();
    }
});

// Script - table - dropdown
jQuery(".dotsScript").click(function () {
    var dotsScript = jQuery(this);
    var dropdownScript = dotsScript.closest("td").find(".dropdown-script");
    dropdownScript.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownScript = jQuery(".dropdown-script");
    if (
        !dropdownScript.is(e.target) &&
        dropdownScript.has(e.target).length === 0
    ) {
        dropdownScript.slideUp();
    }
});

// Librarian - table - dropdown
jQuery(".dotsLibrarian").click(function () {
    var dotsLibrarian = jQuery(this);
    var dropdownLibrarian = dotsLibrarian
        .closest("td")
        .find(".dropdown-librarian");
    dropdownLibrarian.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownLibrarian = jQuery(".dropdown-librarian");
    if (
        !dropdownLibrarian.is(e.target) &&
        dropdownLibrarian.has(e.target).length === 0
    ) {
        dropdownLibrarian.slideUp();
    }
});

// Student - table - dropdown
jQuery(".dotsStudent").click(function () {
    var dotsStudent = jQuery(this);
    var dropdownStudent = dotsStudent.closest("td").find(".dropdown-student");
    dropdownStudent.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownStudent = jQuery(".dropdown-student");
    if (
        !dropdownStudent.is(e.target) &&
        dropdownStudent.has(e.target).length === 0
    ) {
        dropdownStudent.slideUp();
    }
});

// Student - profile - dropdown
jQuery(".dotsStudentProfile").click(function () {
    jQuery(".dropdown-student-profile").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownStudentProfile = jQuery(".dropdown-student-profile");
    if (
        !dropdownStudentProfile.is(e.target) &&
        dropdownStudentProfile.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsStudentProfile")
    ) {
        dropdownStudentProfile.slideUp();
    }
});

// Student - profile - record - dropdown
jQuery(".dotsStudentProfileEvidencija").click(function () {
    jQuery(".dropdown-student-profile-evidencija").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownStudentProfileEvidencija = jQuery(
        ".dropdown-student-profile-evidencija"
    );
    if (
        !dropdownStudentProfileEvidencija.is(e.target) &&
        dropdownStudentProfileEvidencija.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsStudentProfileEvidencija")
    ) {
        dropdownStudentProfileEvidencija.slideUp();
    }
});

// Student - profile - vracene knjige - dropdown
jQuery(".dotsUcenikVraceneKnjige").click(function () {
    jQuery(".ucenik-vracene-knjige").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownUcenikVraceneKnjige = jQuery(".ucenik-vracene-knjige");
    if (
        !dropdownUcenikVraceneKnjige.is(e.target) &&
        dropdownUcenikVraceneKnjige.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsUcenikVraceneKnjige")
    ) {
        dropdownUcenikVraceneKnjige.slideUp();
    }
});

// Student - profile - knjige u prekoracenju - dropdown
jQuery(".dotsUcenikKnjigePrekoracenje").click(function () {
    jQuery(".ucenik-prekoracenje-knjige").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownUcenikKnjigePrekoracenje = jQuery(
        ".ucenik-prekoracenje-knjige"
    );
    if (
        !dropdownUcenikKnjigePrekoracenje.is(e.target) &&
        dropdownUcenikKnjigePrekoracenje.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsUcenikKnjigePrekoracenje")
    ) {
        dropdownUcenikKnjigePrekoracenje.slideUp();
    }
});

// Student - profile - aktivne knjige - dropdown
jQuery(".dotsUcenikKnjigeAktivne").click(function () {
    jQuery(".ucenik-aktivne-knjige").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownUcenikKnjigeAktivne = jQuery(".ucenik-aktivne-knjige");
    if (
        !dropdownUcenikKnjigeAktivne.is(e.target) &&
        dropdownUcenikKnjigeAktivne.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsUcenikKnjigeAktivne")
    ) {
        dropdownUcenikKnjigeAktivne.slideUp();
    }
});

// Student - profile - arhivirane knjige - dropdown
jQuery(".dotsUcenikKnjigeArhivirane").click(function () {
    jQuery(".ucenik-arhivirane-knjige").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownUcenikKnjigeArhivirane = jQuery(".ucenik-arhivirane-knjige");
    if (
        !dropdownUcenikKnjigeArhivirane.is(e.target) &&
        dropdownUcenikKnjigeArhivirane.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsUcenikKnjigeArhivirane")
    ) {
        dropdownUcenikKnjigeArhivirane.slideUp();
    }
});

// Student - profile - book record - dropdown
jQuery(".dotsStudentProfileBookRecord").click(function () {
    var dotsStudentProfileBookRecord = jQuery(this);
    var dropdownStudentProfileEvidencijaKnjige = dotsStudentProfileBookRecord
        .closest("td")
        .find(".dropdown-student-profile-evidencija-knjige");
    dropdownStudentProfileEvidencijaKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownStudentProfileEvidencijaKnjige = jQuery(
        ".dropdown-student-profile-evidencija-knjige"
    );
    if (
        !dropdownStudentProfileEvidencijaKnjige.is(e.target) &&
        dropdownStudentProfileEvidencijaKnjige.has(e.target).length === 0
    ) {
        dropdownStudentProfileEvidencijaKnjige.slideUp();
    }
});

// Student - profile - vracene knjige tabela - dropdown
jQuery(".dotsUcenikVraceneKnjigeTabela").click(function () {
    var dotsUcenikVraceneKnjigeTabela = jQuery(this);
    var dropdownUcenikVraceneKnjigeTabela = dotsUcenikVraceneKnjigeTabela
        .closest("td")
        .find(".ucenik-vracene-knjige-tabela");
    dropdownUcenikVraceneKnjigeTabela.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownUcenikVraceneKnjigeTabela = jQuery(
        ".ucenik-vracene-knjige-tabela"
    );
    if (
        !dropdownUcenikVraceneKnjigeTabela.is(e.target) &&
        dropdownUcenikVraceneKnjigeTabela.has(e.target).length === 0
    ) {
        dropdownUcenikVraceneKnjigeTabela.slideUp();
    }
});

// Student - profile - knjige u prekoracenju tabela - dropdown
jQuery(".dotsUcenikPrekoracenjeKnjige").click(function () {
    var dotsUcenikPrekoracenjeKnjige = jQuery(this);
    var dropdownPrekoracenjeKnjige = dotsUcenikPrekoracenjeKnjige
        .closest("td")
        .find(".ucenik-prekoracenje-knjige-tabela");
    dropdownPrekoracenjeKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownPrekoracenjeKnjige = jQuery(
        ".ucenik-prekoracenje-knjige-tabela"
    );
    if (
        !dropdownPrekoracenjeKnjige.is(e.target) &&
        dropdownPrekoracenjeKnjige.has(e.target).length === 0
    ) {
        dropdownPrekoracenjeKnjige.slideUp();
    }
});

// Student - profile - aktivne knjige tabela - dropdown
jQuery(".dotsUcenikAktivneKnjige").click(function () {
    var dotsUcenikAktivneKnjige = jQuery(this);
    var dropdownAktivneKnjige = dotsUcenikAktivneKnjige
        .closest("td")
        .find(".ucenik-aktivne-knjige-tabela");
    dropdownAktivneKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownAktivneKnjige = jQuery(".ucenik-aktivne-knjige-tabela");
    if (
        !dropdownAktivneKnjige.is(e.target) &&
        dropdownAktivneKnjige.has(e.target).length === 0
    ) {
        dropdownAktivneKnjige.slideUp();
    }
});

// Student - profile - arhivirane knjige tabela - dropdown
jQuery(".dotsUcenikArhiviraneKnjige").click(function () {
    var dotsUcenikArhiviraneKnjige = jQuery(this);
    var dropdownArhiviraneKnjige = dotsUcenikArhiviraneKnjige
        .closest("td")
        .find(".ucenik-arhivirane-knjige-tabela");
    dropdownArhiviraneKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownArhiviraneKnjige = jQuery(".ucenik-arhivirane-knjige-tabela");
    if (
        !dropdownArhiviraneKnjige.is(e.target) &&
        dropdownArhiviraneKnjige.has(e.target).length === 0
    ) {
        dropdownArhiviraneKnjige.slideUp();
    }
});

// Librarian - profile - dropdown
jQuery(".dotsLibrarianProfile").click(function () {
    jQuery(".dropdown-librarian-profile").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownLibrarianProfile = jQuery(".dropdown-librarian-profile");
    if (
        !dropdownLibrarianProfile.is(e.target) &&
        dropdownLibrarianProfile.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsLibrarianProfile")
    ) {
        dropdownLibrarianProfile.slideUp();
    }
});

// Izdate knjige - dropdown
jQuery(".dotsIzdateKnjige").click(function () {
    var dotsIzdateKnjige = jQuery(this);
    var dropdownIzdateKnjige = dotsIzdateKnjige
        .closest("td")
        .find(".izdate-knjige");
    dropdownIzdateKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIzdateKnjige = jQuery(".izdate-knjige");
    if (
        !dropdownIzdateKnjige.is(e.target) &&
        dropdownIzdateKnjige.has(e.target).length === 0
    ) {
        dropdownIzdateKnjige.slideUp();
    }
});

// Vracene knjige - dropdown
jQuery(".dotsVraceneKnjige").click(function () {
    var dotsVraceneKnjige = jQuery(this);
    var dropdownVraceneKnjige = dotsVraceneKnjige
        .closest("td")
        .find(".vracene-knjige");
    dropdownVraceneKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownVraceneKnjige = jQuery(".vracene-knjige");
    if (
        !dropdownVraceneKnjige.is(e.target) &&
        dropdownVraceneKnjige.has(e.target).length === 0
    ) {
        dropdownVraceneKnjige.slideUp();
    }
});

// Knjige u prekoracenju - dropdown
jQuery(".dotsKnjigePrekoracenje").click(function () {
    var dotsKnjigePrekoracenje = jQuery(this);
    var dropdownKnjigePrekoracenje = dotsKnjigePrekoracenje
        .closest("td")
        .find(".knjige-prekoracenje");
    dropdownKnjigePrekoracenje.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownKnjigePrekoracenje = jQuery(".knjige-prekoracenje");
    if (
        !dropdownKnjigePrekoracenje.is(e.target) &&
        dropdownKnjigePrekoracenje.has(e.target).length === 0
    ) {
        dropdownKnjigePrekoracenje.slideUp();
    }
});

// Aktivne rezervacije - dropdown
jQuery(".dotsAktivneRezervacije").click(function () {
    var dotsAktivneRezervacije = jQuery(this);
    var dropdownAktivneRezervacije = dotsAktivneRezervacije
        .closest("td")
        .find(".aktivne-rezervacije");
    dropdownAktivneRezervacije.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownAktivneRezervacije = jQuery(".aktivne-rezervacije");
    if (
        !dropdownAktivneRezervacije.is(e.target) &&
        dropdownAktivneRezervacije.has(e.target).length === 0
    ) {
        dropdownAktivneRezervacije.slideUp();
    }
});

// Arhivirane rezervacije - dropdown
jQuery(".dotsArhiviraneRezervacije").click(function () {
    var dotsArhiviraneRezervacije = jQuery(this);
    var dropdownArhiviraneRezervacije = dotsArhiviraneRezervacije
        .closest("td")
        .find(".arhivirane-rezervacije");
    dropdownArhiviraneRezervacije.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownArhiviraneRezervacije = jQuery(".arhivirane-rezervacije");
    if (
        !dropdownArhiviraneRezervacije.is(e.target) &&
        dropdownArhiviraneRezervacije.has(e.target).length === 0
    ) {
        dropdownArhiviraneRezervacije.slideUp();
    }
});

// Autori - dropdown
jQuery(".dotsAutori").click(function () {
    var dotsAutori = jQuery(this);
    var dropdownAutori = dotsAutori.closest("td").find(".dropdown-autori");
    dropdownAutori.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownAutori = jQuery(".dropdown-autori");
    if (
        !dropdownAutori.is(e.target) &&
        dropdownAutori.has(e.target).length === 0
    ) {
        dropdownAutori.slideUp();
    }
});

// Autori - profile - dropdown
jQuery(".dotsAutor").click(function () {
    jQuery(".dropdown-autor").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownAutor = jQuery(".dropdown-autor");
    if (
        !dropdownAutor.is(e.target) &&
        dropdownAutor.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsAutor")
    ) {
        dropdownAutor.slideUp();
    }
});

// Knjige - dropdown
jQuery(".dotsKnjige").click(function () {
    var dotsKnjige = jQuery(this);
    var dropdownKnjige = dotsKnjige.closest("td").find(".dropdown-knjige");
    dropdownKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownKnjige = jQuery(".dropdown-knjige");
    if (
        !dropdownKnjige.is(e.target) &&
        dropdownKnjige.has(e.target).length === 0
    ) {
        dropdownKnjige.slideUp();
    }
});

// Knjiga - osnovni detalji - dropdown
jQuery(".dotsKnjigaOsnovniDetalji").click(function () {
    jQuery(".dropdown-knjiga-osnovni-detalji").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownKnjigaOsnovniDetalji = jQuery(
        ".dropdown-knjiga-osnovni-detalji"
    );
    if (
        !dropdownKnjigaOsnovniDetalji.is(e.target) &&
        dropdownKnjigaOsnovniDetalji.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsKnjigaOsnovniDetalji")
    ) {
        dropdownKnjigaOsnovniDetalji.slideUp();
    }
});

// Izdaj knjigu - dropdown
jQuery(".dotsIzdajKnjigu").click(function () {
    jQuery(".dropdown-izdaj-knjigu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIzdajKnjigu = jQuery(".dropdown-izdaj-knjigu");
    if (
        !dropdownIzdajKnjigu.is(e.target) &&
        dropdownIzdajKnjigu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIzdajKnjigu")
    ) {
        dropdownIzdajKnjigu.slideUp();
    }
});

// Izdaj knjigu error - dropdown
jQuery(".dotsIzdajKnjiguError").click(function () {
    jQuery(".dropdown-izdaj-knjigu-error").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIzdajKnjiguError = jQuery(".dropdown-izdaj-knjigu-error");
    if (
        !dropdownIzdajKnjiguError.is(e.target) &&
        dropdownIzdajKnjiguError.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIzdajKnjiguError")
    ) {
        dropdownIzdajKnjiguError.slideUp();
    }
});

// Vrati knjigu - dropdown
jQuery(".dotsVratiKnjigu").click(function () {
    jQuery(".dropdown-vrati-knjigu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownVratiKnjigu = jQuery(".dropdown-vrati-knjigu");
    if (
        !dropdownVratiKnjigu.is(e.target) &&
        dropdownVratiKnjigu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsVratiKnjigu")
    ) {
        dropdownVratiKnjigu.slideUp();
    }
});

// Rezervisi knjigu - dropdown
jQuery(".dotsRezervisiKnjigu").click(function () {
    jQuery(".dropdown-rezervisi-knjigu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownRezervisiKnjigu = jQuery(".dropdown-rezervisi-knjigu");
    if (
        !dropdownRezervisiKnjigu.is(e.target) &&
        dropdownRezervisiKnjigu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsRezervisiKnjigu")
    ) {
        dropdownRezervisiKnjigu.slideUp();
    }
});

// Otpisi knjigu - dropdown
jQuery(".dotsOtpisiKnjigu").click(function () {
    jQuery(".dropdown-otpisi-knjigu").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownOtpisiKnjigu = jQuery(".dropdown-otpisi-knjigu");
    if (
        !dropdownOtpisiKnjigu.is(e.target) &&
        dropdownOtpisiKnjigu.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsOtpisiKnjigu")
    ) {
        dropdownOtpisiKnjigu.slideUp();
    }
});

// Knjiga - specifikacija - dropdown
jQuery(".dotsKnjigaSpecifikacija").click(function () {
    jQuery(".dropdown-knjiga-specifikacija").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownKnjigaSpecifikacija = jQuery(".dropdown-knjiga-specifikacija");
    if (
        !dropdownKnjigaSpecifikacija.is(e.target) &&
        dropdownKnjigaSpecifikacija.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsKnjigaSpecifikacija")
    ) {
        dropdownKnjigaSpecifikacija.slideUp();
    }
});

// Knjiga - multimedija - dropdown
jQuery(".dotsKnjigaMultimedija").click(function () {
    jQuery(".dropdown-knjiga-multimedija").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownKnjigaMultimedija = jQuery(".dropdown-knjiga-multimedija");
    if (
        !dropdownKnjigaMultimedija.is(e.target) &&
        dropdownKnjigaMultimedija.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsKnjigaMultimedija")
    ) {
        dropdownKnjigaMultimedija.slideUp();
    }
});

// Iznajmljivanje - izdate - dropdown
jQuery(".dotsIznajmljivanjeIzdate").click(function () {
    jQuery(".dropdown-iznajmljivanje-izdate").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeIzdate = jQuery(
        ".dropdown-iznajmljivanje-izdate"
    );
    if (
        !dropdownIznajmljivanjeIzdate.is(e.target) &&
        dropdownIznajmljivanjeIzdate.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIznajmljivanjeIzdate")
    ) {
        dropdownIznajmljivanjeIzdate.slideUp();
    }
});

// Iznajmljivanje - vracene - dropdown
jQuery(".dotsIznajmljivanjeVracene").click(function () {
    jQuery(".dropdown-iznajmljivanje-vracene").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeVracene = jQuery(
        ".dropdown-iznajmljivanje-vracene"
    );
    if (
        !dropdownIznajmljivanjeVracene.is(e.target) &&
        dropdownIznajmljivanjeVracene.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIznajmljivanjeVracene")
    ) {
        dropdownIznajmljivanjeVracene.slideUp();
    }
});

// Iznajmljivanje - prekoracenje - dropdown
jQuery(".dotsIznajmljivanjePrekoracenje").click(function () {
    jQuery(".dropdown-iznajmljivanje-prekoracenje").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjePrekoracenje = jQuery(
        ".dropdown-iznajmljivanje-prekoracenje"
    );
    if (
        !dropdownIznajmljivanjePrekoracenje.is(e.target) &&
        dropdownIznajmljivanjePrekoracenje.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIznajmljivanjePrekoracenje")
    ) {
        dropdownIznajmljivanjePrekoracenje.slideUp();
    }
});

// Iznajmljivanje - aktivne rezervacije - dropdown
jQuery(".dotsIznajmljivanjeAktivneRezervacije").click(function () {
    jQuery(".dropdown-iznajmljivanje-aktivne-rezervacije").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeAktivneRezervacije = jQuery(
        ".dropdown-iznajmljivanje-aktivne-rezervacije"
    );
    if (
        !dropdownIznajmljivanjeAktivneRezervacije.is(e.target) &&
        dropdownIznajmljivanjeAktivneRezervacije.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIznajmljivanjeAktivneRezervacije")
    ) {
        dropdownIznajmljivanjeAktivneRezervacije.slideUp();
    }
});

// Iznajmljivanje - arhivirane rezervacije - dropdown
jQuery(".dotsIznajmljivanjeArhiviraneRezervacije").click(function () {
    jQuery(".dropdown-iznajmljivanje-arhivirane-rezervacije").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeArhiviraneRezervacije = jQuery(
        ".dropdown-iznajmljivanje-arhivirane-rezervacije"
    );
    if (
        !dropdownIznajmljivanjeArhiviraneRezervacije.is(e.target) &&
        dropdownIznajmljivanjeArhiviraneRezervacije.has(e.target).length ===
            0 &&
        !jQuery(e.target).is(".dotsIznajmljivanjeArhiviraneRezervacije")
    ) {
        dropdownIznajmljivanjeArhiviraneRezervacije.slideUp();
    }
});

// Izdavanje - detalji - dropdown
jQuery(".dotsIzdavanjeDetalji").click(function () {
    jQuery(".dropdown-izdavanje-detalji").toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIzdavanjeDetalji = jQuery(".dropdown-izdavanje-detalji");
    if (
        !dropdownIzdavanjeDetalji.is(e.target) &&
        dropdownIzdavanjeDetalji.has(e.target).length === 0 &&
        !jQuery(e.target).is(".dotsIzdavanjeDetalji")
    ) {
        dropdownIzdavanjeDetalji.slideUp();
    }
});

// Iznajmljivanje - izdate knjige - tabela - dropdown
jQuery(".dotsIznajmljivanjeIzdateKnjige").click(function () {
    var dotsIznajmljivanjeIzdateKnjige = jQuery(this);
    var dropdownIznajmljivanjeIzdateKnjige = dotsIznajmljivanjeIzdateKnjige
        .closest("td")
        .find(".iznajmljivanje-izdate-knjige");
    dropdownIznajmljivanjeIzdateKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeIzdateKnjige = jQuery(
        ".iznajmljivanje-izdate-knjige"
    );
    if (
        !dropdownIznajmljivanjeIzdateKnjige.is(e.target) &&
        dropdownIznajmljivanjeIzdateKnjige.has(e.target).length === 0
    ) {
        dropdownIznajmljivanjeIzdateKnjige.slideUp();
    }
});

// Iznajmljivanje - vracene knjige - tabela - dropdown
jQuery(".dotsIznajmljivanjeVraceneKnjige").click(function () {
    var dotsIznajmljivanjeVraceneKnjige = jQuery(this);
    var dropdownIznajmljivanjeVraceneKnjige = dotsIznajmljivanjeVraceneKnjige
        .closest("td")
        .find(".iznajmljivanje-vracene-knjige");
    dropdownIznajmljivanjeVraceneKnjige.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeVraceneKnjige = jQuery(
        ".iznajmljivanje-vracene-knjige"
    );
    if (
        !dropdownIznajmljivanjeVraceneKnjige.is(e.target) &&
        dropdownIznajmljivanjeVraceneKnjige.has(e.target).length === 0
    ) {
        dropdownIznajmljivanjeVraceneKnjige.slideUp();
    }
});

// Iznajmljivanje - knjige u prekoracenju - tabela - dropdown
jQuery(".dotsIznajmljivanjeKnjigePrekoracenje").click(function () {
    var dotsIznajmljivanjeKnjigePrekoracenje = jQuery(this);
    var dropdownIznajmljivanjeKnjigePrekoracenje =
        dotsIznajmljivanjeKnjigePrekoracenje
            .closest("td")
            .find(".iznajmljivanje-knjige-prekoracenje");
    dropdownIznajmljivanjeKnjigePrekoracenje.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeKnjigePrekoracenje = jQuery(
        ".iznajmljivanje-knjige-prekoracenje"
    );
    if (
        !dropdownIznajmljivanjeKnjigePrekoracenje.is(e.target) &&
        dropdownIznajmljivanjeKnjigePrekoracenje.has(e.target).length === 0
    ) {
        dropdownIznajmljivanjeKnjigePrekoracenje.slideUp();
    }
});

// Iznajmljivanje - aktivne rezervacije - tabela - dropdown
jQuery(".dotsIznajmljivanjeAktivneRezervacijeTabela").click(function () {
    var dotsIznajmljivanjeAktivneRezervacijeTabela = jQuery(this);
    var dropdownIznajmljivanjeAktivneRezervacijeTabela =
        dotsIznajmljivanjeAktivneRezervacijeTabela
            .closest("td")
            .find(".iznajmljivanje-aktivne-rezervacije");
    dropdownIznajmljivanjeAktivneRezervacijeTabela.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeAktivneRezervacijeTabela = jQuery(
        ".iznajmljivanje-aktivne-rezervacije"
    );
    if (
        !dropdownIznajmljivanjeAktivneRezervacijeTabela.is(e.target) &&
        dropdownIznajmljivanjeAktivneRezervacijeTabela.has(e.target).length ===
            0
    ) {
        dropdownIznajmljivanjeAktivneRezervacijeTabela.slideUp();
    }
});

// Iznajmljivanje - aktivne rezervacije - tabela - dropdown
jQuery(".dotsIznajmljivanjeArhiviraneRezervacijeTabela").click(function () {
    var dotsIznajmljivanjeArhiviraneRezervacijeTabela = jQuery(this);
    var dropdownIznajmljivanjeArhiviraneRezervacijeTabela =
        dotsIznajmljivanjeArhiviraneRezervacijeTabela
            .closest("td")
            .find(".iznajmljivanje-arhivirane-rezervacije");
    dropdownIznajmljivanjeArhiviraneRezervacijeTabela.toggle();
});

jQuery(document).on("mouseup", function (e) {
    var dropdownIznajmljivanjeArhiviraneRezervacijeTabela = jQuery(
        ".iznajmljivanje-arhivirane-rezervacije"
    );
    if (
        !dropdownIznajmljivanjeArhiviraneRezervacijeTabela.is(e.target) &&
        dropdownIznajmljivanjeArhiviraneRezervacijeTabela.has(e.target)
            .length === 0
    ) {
        dropdownIznajmljivanjeArhiviraneRezervacijeTabela.slideUp();
    }
});

//click on one and check all checkboxes(evidencijaKnjiga.php)
jQuery(".checkAll").click(function () {
    if (jQuery(this).is(":checked")) {
        jQuery(".form-checkbox").prop("checked", true);
        jQuery("tr").addClass("bg-gray-200");
        jQuery("tr")
            .children()
            .eq(1)
            .html(
                '<a class="text-blue-800 border-l-2 border-gray-200" href="otpisiKnjigu.php"><i class="fa fa-trash ml-4"></i>  Izbrisi knjigu</a>'
            );
        jQuery("tr").children().eq(2).html("");
        jQuery("tr").children().eq(3).html("");
        jQuery("tr").children().eq(4).html("");
        jQuery("tr").children().eq(5).html("");
        jQuery("tr").children().eq(6).html("");
        jQuery("tr").children().eq(7).html("");
        jQuery("tr").children().eq(8).html("");
    } else {
        jQuery(".form-checkbox").prop("checked", false);
        jQuery("tr").removeClass("bg-gray-200");
        jQuery("tr")
            .children()
            .eq(1)
            .html(
                'Naziv knjige<a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down" onclick="sortTable()"></i></a>'
            );
        jQuery("tr")
            .children()
            .eq(2)
            .html(
                'Autor<i class="ml-2 fas fa-filter"></i><div id="autoriDropdown" class="autoriMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300"><ul class="border-b-2 border-gray-300 list-reset"><li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300"><input class="w-full h-10 px-2 border-2 rounded focus:outline-none" placeholder="Search" onkeyup="filterFunction(" searchAutori ", "autoriDropdown ")" id="searchAutori"><br> <button class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900"><i class="fas fa-search"></i></button></li><div class="h-[200px] scroll font-normal"> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Autor Autorovic </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 2 </p>  </li>  <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg>  </div> </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 3  </p> </li>  <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Autor Autorovic 4  </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 5 </p> </li><li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"><input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 6 </p> </li> </div></ul><div class="flex pt-[10px] text-white "> <a href="#" class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">  Sacuvaj <i class="fas fa-check ml-[4px]"></i> </a> <a href="#"  class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]"> Ponisti <i class="fas fa-times ml-[4px]"></i> </a> </div></div>'
            );
        jQuery("tr")
            .children()
            .eq(3)
            .html(
                'Kategorija<i class="ml-2 fas fa-filter"></i><div id="kategorijeDropdown" class="kategorijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300"><ul class="border-b-2 border-gray-300 list-reset">  <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300"> <input class="w-full h-10 px-2 border-2 rounded focus:outline-none" placeholder="Search"  onkeyup="filterFunction("searchKategorije", "kategorijeDropdown")"  id="searchKategorije"><br><button class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">  <i class="fas fa-search"></i> </button> </li><div class="h-[200px] scroll font-normal"> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />   </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Romani </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Udzbenici </p></li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div   class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Drame </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg>  </div> </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Naucna fantastika </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Romedije  </p>  </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start"> <div   class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"   viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Trileri </p> </li> </div> </ul> <div class="flex pt-[10px] text-white "> <a href="#" class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]"> Sacuvaj <i class="fas fa-check ml-[4px]"></i> </a>  <a href="#" class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">  Ponisti <i class="fas fa-times ml-[4px]"></i> </a></div></div>'
            );
        jQuery("tr").children().eq(4).html("Na raspolaganju");
        jQuery("tr").children().eq(5).html("Rezervisano");
        jQuery("tr").children().eq(6).html("Izdato");
        jQuery("tr").children().eq(7).html("U prekoracenju");
        jQuery("tr").children().eq(8).html("Ukupna kolicina");
    }
});
jQuery(".checkOthers").change(function () {
    var checked = jQuery("#myTable").find(":checked").length;
    if (checked == 1) {
        jQuery(this).addClass("bg-gray-200");
        jQuery("tr")
            .children()
            .eq(1)
            .html(
                '<a class="text-blue-800" href="knjigaOsnovniDetalji.php"><i class="far fa-copy"></i>  Pogledaj detalje</a>'
            );
        jQuery("tr")
            .children()
            .eq(2)
            .html(
                '<a class="text-blue-800" href="editKnjiga.php.php"><i class="far fa-copy"></i>  Izmjeni knjigu</a>'
            );
        jQuery("tr")
            .children()
            .eq(3)
            .html(
                '<a class="text-blue-800 border-l-2 border-gray-200" href="otpisiKnjigu.php"><i class="fas fa-level-up-alt ml-4"></i>  Otpisi knjigu</a>'
            );
        jQuery("tr")
            .children()
            .eq(4)
            .html(
                '<a class="text-blue-800" href="izdajKnjigu.php"><i class="far fa-hand-scissors"></i>  Izdaj knjigu</a>'
            );
        jQuery("tr")
            .children()
            .eq(5)
            .html(
                '<a class="text-blue-800" href="vratiKnjigu.php"><i class="fas fa-redo-alt"></i>  Vrati knjigu</a>'
            );
        jQuery("tr")
            .children()
            .eq(6)
            .html(
                '<a class="text-blue-800" href="otpisiKnjigu.php"><i class="far fa-calendar-check"></i>  Rezervisi knjigu</a>'
            );
        jQuery("tr")
            .children()
            .eq(7)
            .html(
                '<a class="text-blue-800 border-l-2 border-gray-200" href="otpisiKnjigu.php"><i class="fa fa-trash ml-4"></i>  Izbrisi knjigu</a>'
            );
        jQuery("tr").children().eq(8).html("");
    } else if (checked >= 2) {
        jQuery(this).addClass("bg-gray-200");
        jQuery("tr")
            .children()
            .eq(1)
            .html(
                '<a class="text-blue-800 border-l-2 border-gray-200" href="otpisiKnjigu.php"><i class="fa fa-trash ml-4"></i>  Izbrisi knjigu</a>'
            );
        jQuery("tr").children().eq(2).html("");
        jQuery("tr").children().eq(3).html("");
        jQuery("tr").children().eq(4).html("");
        jQuery("tr").children().eq(5).html("");
        jQuery("tr").children().eq(6).html("");
        jQuery("tr").children().eq(7).html("");
        jQuery("tr").children().eq(8).html("");
    } else {
        jQuery(".form-checkbox").prop("checked", false);
        jQuery("tr").removeClass("bg-gray-200");
        jQuery("tr")
            .children()
            .eq(1)
            .html(
                'Naziv knjige<a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down" onclick="sortTable()"></i></a>'
            );
        jQuery("tr")
            .children()
            .eq(2)
            .html(
                'Autor<i class="ml-2 fas fa-filter"></i><div id="autoriDropdown" class="autoriMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300"><ul class="border-b-2 border-gray-300 list-reset"><li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300"><input class="w-full h-10 px-2 border-2 rounded focus:outline-none" placeholder="Search" onkeyup="filterFunction(" searchAutori ", "autoriDropdown ")" id="searchAutori"><br> <button class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900"><i class="fas fa-search"></i></button></li><div class="h-[200px] scroll font-normal"> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Autor Autorovic </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 2 </p>  </li>  <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg>  </div> </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 3  </p> </li>  <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Autor Autorovic 4  </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 5 </p> </li><li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"><input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg> </div> </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Autor Autorovic 6 </p> </li> </div></ul><div class="flex pt-[10px] text-white "> <a href="#" class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">  Sacuvaj <i class="fas fa-check ml-[4px]"></i> </a> <a href="#"  class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]"> Ponisti <i class="fas fa-times ml-[4px]"></i> </a> </div></div>'
            );
        jQuery("tr")
            .children()
            .eq(3)
            .html(
                'Kategorija<i class="ml-2 fas fa-filter"></i><div id="kategorijeDropdown" class="kategorijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-t pin-l border-2 border-gray-300"><ul class="border-b-2 border-gray-300 list-reset">  <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300"> <input class="w-full h-10 px-2 border-2 rounded focus:outline-none" placeholder="Search"  onkeyup="filterFunction("searchKategorije", "kategorijeDropdown")"  id="searchKategorije"><br><button class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">  <i class="fas fa-search"></i> </button> </li><div class="h-[200px] scroll font-normal"> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />   </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Romani </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div  class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current" viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Udzbenici </p></li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start"> <div   class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0"> <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label>  <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Drame </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200"> <label class="flex items-center justify-start">  <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />  </svg>  </div> </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600"> Naucna fantastika </p> </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start"> <div class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500"> <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"  viewBox="0 0 20 20">  <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div> </label> <p class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Romedije  </p>  </li> <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">  <label class="flex items-center justify-start"> <div   class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">  <input type="checkbox" class="absolute opacity-0">  <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"   viewBox="0 0 20 20"> <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /> </svg> </div>  </label> <p  class="block p-2 text-black cursor-pointer group-hover:text-blue-600">  Trileri </p> </li> </div> </ul> <div class="flex pt-[10px] text-white "> <a href="#" class="py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]"> Sacuvaj <i class="fas fa-check ml-[4px]"></i> </a>  <a href="#" class="ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">  Ponisti <i class="fas fa-times ml-[4px]"></i> </a></div></div>'
            );
        jQuery("tr").children().eq(4).html("Na raspolaganju");
        jQuery("tr").children().eq(5).html("Rezervisano");
        jQuery("tr").children().eq(6).html("Izdato");
        jQuery("tr").children().eq(7).html("U prekoracenju");
        jQuery("tr").children().eq(8).html("Ukupna kolicina");
    }
});
