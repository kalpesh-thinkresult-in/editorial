<?= $this->extend('dashboard/include/admin_layout') ?>

<!-- Page style -->
<?= $this->section('stylesheet') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.dataTables.min.css">
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font: 16px Arial;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=text] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <datalist id="suggestions">
                        <?php if (!empty($list)): ?>
                            <?php foreach ($list as $item): ?>
                                <option value="<?= $item->id ?>"><?= $item->menu ?></option>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </datalist>
                    <input autoComplete="on" list="suggestions" />
                </div>

                <div class="col-sm-6">
                    <div class="autocomplete" style="width:300px;">
                        <input id="inpCategory" type="text" name="inpCategory" placeholder="Category">
                    </div>
                    <br /><br /><br /><br />
                    <select name="selcategory" id="selcategory" size="10" class="form-control">

                    </select>
                </div>
            </div>
        </div>
        <div>
            <p> Place <em>some</em> <u>text</u> <strong>here</strong>&nbsp;<a href="http://www.google.com"
                    target="_blank">Goolge</a></p>
        </div>
    </section>

</div>

<!-- /.content-wrapper -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<script>
    var menus = JSON.parse('<?= $menus ?>');
    console.log(menus);
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false; }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                // if (arr[i].menu.substr(0, val.length).toUpperCase() == val.toUpperCase()) 
                var indx = arr[i].menu.toUpperCase().indexOf(val.toUpperCase());
                if (indx > 0) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML += arr[i].menu.substr(0, indx);
                    b.innerHTML += "<strong>" + arr[i].menu.substr(indx, val.length) + "</strong>";
                    b.innerHTML += arr[i].menu.substr(indx + val.length, arr[i].menu.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i].id + "'>";
                    b.innerHTML += "<input type='hidden' value='" + arr[i].menu + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function (e) {
                        /*insert the value for the autocomplete text field:*/
                        //inp.value = this.getElementsByTagName("input")[0].value;
                        var x = document.getElementById("selcategory");
                        var option = document.createElement("option");
                        option.value = this.getElementsByTagName("input")[0].value;
                        option.text = this.getElementsByTagName("input")[1].value;
                        x.add(option);
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }


    /*initiate the autocomplete function on the "inpCategory" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("inpCategory"), menus);
</script>

<?= $this->endSection() ?>