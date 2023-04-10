<?= $this->extend('dashboard/include/admin_layout') ?>
<?= $this->section('stylesheet') ?>
<style>
    .note-editor.note-airframe .note-editing-area .note-editable,
    .note-editor.note-frame .note-editing-area .note-editable {
        height: 300px !important;
    }

    .select2-container--default .select2-search--inline .select2-search__field {
        width: 5.75em !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <style>
    .hideMe {
        position: absolute;
        z-index: 99999;
        top:100;
        right:0;
        padding: 20px;
        padding-right: 40px;
        border-radius: 15px 0px 0px 15px;

        -webkit-animation: cssAnimation 5s forwards; 
        animation: cssAnimation 5s forwards;
}
@keyframes cssAnimation {
    0%   {opacity: 1;}
    60%  {opacity: 0.8;}
    70%  {opacity: 0.5;}
    80%  {opacity: 0.3;}
    100% {opacity: 0;}
}
@-webkit-keyframes cssAnimation {
    0%   {opacity: 1;}
    60%  {opacity: 0.8;}
    70%  {opacity: 0.5;}
    80%  {opacity: 0.3;}
    100% {opacity: 0;}
}
</style>                            
<div>
    <?php if($successmsg!=""):
        echo '<div class="bg-success hideMe">'.$successmsg.'</div>';
    endif;?>
</div>
            <h3>News</h3>            
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="hdnid" value="<?= (isset($newsdata->id)) ? $newsdata->id : '' ?>" />
                <input type="hidden" name="hdnlang"
                    value="<?= (isset($newsdata->lang)) ? $newsdata->lang : $langsmall ?>" />
                <div class="row">
                    <div class="col-md-7"><!-- Main Columns -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            News Heading
                                        </h3>
                                        <div class="float-right">
                                            <label class="form-check-label" for="chkshowrss">Type</label>
                                            <select id="priority" name="priority" class="ml-2">
                                                <option value="1"
                                                    <?= (isset($newsdata->priority)) ? (($newsdata->priority == 1) ? "selected" : "") : ""; ?>>
                                                    REGULAR</option>
                                                <option value="2"
                                                    <?= (isset($newsdata->priority)) ? (($newsdata->priority == 2) ? "selected" : "") : ""; ?>>
                                                    FEATURE</option>
                                                <option value="3"
                                                    <?= (isset($newsdata->priority)) ? (($newsdata->priority == 3) ? "selected" : "") : ""; ?>>
                                                    LATEST</option>
                                                <option value="4"
                                                    <?= (isset($newsdata->priority)) ? (($newsdata->priority == 4) ? "selected" : "") : ""; ?>>
                                                    TOP</option>
                                                <option value="5"
                                                    <?= (isset($newsdata->priority)) ? (($newsdata->priority == 5) ? "selected" : "") : ""; ?>>
                                                    MOST POPULAR</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="txttitle">Title</label>
                                            <input type="text" class="form-control" id="txttitle" name="txttitle"
                                                placeholder="Enter News Title"
                                                value="<?= (isset($newsdata->heading)) ? $newsdata->heading : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtslug">Slug</label>
                                            <input type="text" class="form-control" id="txtslug" name="txtslug"
                                                placeholder="Enter Slug"
                                                value="<?= (isset($newsdata->slug)) ? $newsdata->slug : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Detailed News
                                        </h3>
                                        <div class="float-right">
                                            <a href="javascript:void(0)" id="lnkslink">Create Stock Link</a>
                                        </div>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <textarea id="newsdescription" name="newsdescription"
                                            style="height:300px!important;"><?= (isset($newsdata->news)) ? $newsdata->news : '' ?></textarea>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Source
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <input type="text" class="form-control" id="txtsource" name="txtsource"
                                            placeholder="Enter Source"
                                            value="<?= (isset($newsdata->source)) ? $newsdata->source : '' ?>">
                                    </div>
                                </div>
                            </div><!-- /.col-->
                            <div class="col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Video Link
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <input type="text" class="form-control" id="txtvideolink" name="txtvideolink"
                                            placeholder="Enter Video Link"
                                            value="<?= (isset($newsdata->videolink)) ? $newsdata->videolink : '' ?>">
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Image [
                                            <?php
                                            if (isset($newsdata->imageurl)) {
                                                if (!empty($newsdata->imageurl)) {
                                                    echo '<a href="' . $newsdata->imageurl . '" target="_blank">View</a>';
                                                }
                                            }
                                            ?>
                                            ]
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <input type="file" class="form-control" id="txtimageurl" name="txtimageurl"
                                            placeholder="Select Image" value="" accept="image/*">

                                    </div>
                                </div>
                            </div><!-- /.col-->
                            <div class="col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Image Title
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <input type="text" class="form-control" id="txtimagetitle" name="txtimagetitle"
                                            placeholder="Enter Image Title"
                                            value="<?= (isset($newsdata->imagetitle)) ? $newsdata->imagetitle : '' ?>">
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                    </div><!-- Main Columns -->
                    <div class="col-md-5"><!-- Main Columns -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Categories
                                        </h3>
                                        <a class="float-right" href="javascript:void(0)" id="showcate">Open</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <select id="selcategory" class="form-control" name="selcategory[]"
                                            multiple="multiple">
                                            <?php if (!empty($menulist)):
                                                $selected = ""; ?>
                                                <?php foreach ($menulist as $item):
                                                    $selected = (!empty($item->newsid)) ? "selected" : "";
                                                    ?>
                                                    <option value="<?= $item->id ?>" <?= $selected ?>><?= $item->menu ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Tags
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <select id="seltags" class="form-control" name="tags[]" multiple="multiple">
                                            <?php if (!empty($tags)):
                                                $selected = ""; ?>
                                                <?php foreach ($tags as $tag):
                                                    $selected = (strpos($tag, "#%@") == "") ? "selected" : "";
                                                    $val = str_replace("#%@", "", $tag);
                                                    if (!empty($val)): ?>
                                                        <option value="<?= $val ?>" <?= $selected ?>><?= $val ?></option>
                                                    <?php endif;
                                                endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Stock Codes
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <select id="selstockcodes" class="form-control" name="sockcode[]"
                                            multiple="multiple">
                                            <?php if (!empty($ks)):
                                                $selected = ""; ?>
                                                <?php foreach ($ks as $item):
                                                    $selected = (strpos($item, "#%@") == "") ? "selected" : "";
                                                    $val = str_replace("#%@", "", $item);
                                                    if (!empty($item)): ?>
                                                        <option value="<?= $val ?>" <?= $selected ?>><?= $val ?></option>
                                                    <?php endif;
                                                endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title" style="width:100%!important;">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="chkshowrss"
                                                            name="chkshowrss" <?= (isset($newsdata->showinrss) && $newsdata->showinrss == 1) ? "checked" : "" ?>>
                                                        <label class="form-check-label" for="chkshowrss">Show in
                                                            RSS</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">

                                                </div>
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="btnsubmit" class="btn btn-danger" value="Save" />
                                <a href="<?= base_url("news/details/$langsmall") ?>"
                                    class="btn btn-default float-right">Add New</a>
                                <a href="<?= base_url("news/list/$langsmall") ?>"
                                    class="btn btn-default float-right">Back
                                    to
                                    List</a>
                            </div><!-- /.col-->
                        </div><!-- ./row -->
                    </div><!-- Main Columns -->
                </div><!-- /.Row -->
            </form>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--============================================= modals ==================================================-->
<!--=======================================================================================================-->
<!-- Model -->
<div class="modal fade" id="mdstocklink" style="display: none;" data-backdrop="static" data-keyboard="false"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Stock Link</span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group"><label for="selCompanyStockCode">Text to display</label>
                    <select id="selCompanyStockCode" class="form-control select2" style="width: 100%">
                        <option selected="selected" value="-1">Select</option>
                        <?php
                        if ((isset($stockcodes)) && (!empty($stockcodes))) {
                            foreach ($stockcodes as $stockcode) {
                                echo "<option value=\"$stockcode->stockcode\">$stockcode->company</option>";
                            }
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" id="btncreatelink" class="btn btn-primary">Create Link</button>
                <button type="button" class="btn btn-default" id="mdcl3">Close</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<!--============================================= modals ==================================================-->
<!--=======================================================================================================-->
<!-- Model -->
<div class="modal fade" id="mdcate" style="display: none;" data-backdrop="static" data-keyboard="false"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Categories</span></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="dvcate">
                    
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-default" id="mdcl4">Close</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- Page specific script -->
<script>
    let categories=JSON.parse('<?=$menus?>');
    let clients=JSON.parse('<?=$clients?>');
    
    var baseurl = "<?= base_url("webgeneral/stockpage/") ?>";
    var sel = null, range = null;
    $(function () {
        //==============================================================================================
        //initialization
        //==============================================================================================
        //init html editor
        $('#newsdescription').summernote()

        //init selects
        $('#selcategory').select2();
        $("#selCompanyStockCode").select2();
        $('#seltags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        $('#selstockcodes').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        //binding client and categories
        const bindcategories = ()=>{
            let divhtml = "";
            let cindex = 1;
            
            if(clients.length>0){
                let cdata = $('#selcategory').val();

                $.each(clients, function(key,value) {
                    let clientid=value.id;
                    let html = "";
                    var cates = categories.filter(element => element.clientid == clientid)
                    if (cates != null && cates.length > 0) {
                        //building header tags of select
                        html+='<div class="col-2">';
                        html+="<b>"+value.clientname+"</b>";
                        html+='<select id="catemenu'+cindex+'" data-id="catemenu'+cindex+'" multiple="" class="form-control clscatsel" style="height:300px;">';
                        
                        $.each(cates, function(ckey,cvalue) {
                            //adding options in select
                                let selected = "";
                                let indx = $.inArray(cvalue.id, cdata);
                                if(indx > -1){
                                    selected="selected";
                                }
                                html+='<option value="'+ cvalue.id +'" '+ selected +'>'+cvalue.menu+'</option>';
                        })      

                        //closing header tags
                        html+="</select>";
                        html+="</div>";
                    }
                    //adding main div html
                    divhtml +=html;
                    cindex+=1;
                });     
            }
            $("#dvcate").html(divhtml);
        }
        bindcategories(); // calling to bind

        $(document).on('click',".clscatsel", function(){
            let cdata = $('#selcategory').val();
            
            let controlid = $(this).data("id");
            $("#"+controlid).find("option").each(function() {
                let indx = $.inArray(this.value, cdata);                        
                
                if(this.selected){
                    if (indx < 0) cdata.push(this.value);
                }
                else{
                    if (indx > -1) cdata.splice(indx,1);
                }
            });

             
             $('#selcategory').val(cdata).trigger('change');
        });
        //==============================================================================================

        //defineing element to load html in news-description textarea after adding stockcode link
        var elementnews = document.getElementsByClassName('note-editable');


        $("#txttitle").change(function () {
            $("#txtslug").val(slugify($(this).val()));
        })

        $("#lnkslink").click(function () {
            if (window.getSelection) {
                if (sel == "") {
                    alert("Select text to make link ...");
                    return false
                };
                sel = window.getSelection();
                range = sel.getRangeAt(0);
                $('#mdstocklink').modal('toggle');
            }
            else {
                alert("Browser doesn't support this action......");
            }
            //getSelectionHtml();

        })
        $("#btncreatelink").click(function () {
            if ($("#selCompanyStockCode").val() == "-1") {
                alert("Select Company to Create Stock Link");
                return false;
            }
            else {
                getSelectionHtml();
                $("#newsdescription").val(elementnews[0].innerHTML);
                clearmodal();
            }
        });
        $("#mdcl3").click(function () {
            clearmodal();
        });
        function clearmodal() {
            $("#selCompanyStockCode").val(-1);
            $('#mdstocklink').modal('toggle');
        }

        $("#showcate").click(function(){
            $('#mdcate').modal('toggle');  
            bindcategories();
        })
        $("#mdcl4").click(function () {
            clearmodalcate();
        });
        function clearmodalcate() {
            $('#mdcate').modal('toggle');
        }

    })

    function getSelectionHtml() {
        var node;
        let code = $("#selCompanyStockCode").val();
        var html = '<a href="' + baseurl + code + '" target="_blank">' + range + '</a>';
        range.deleteContents();

        var el = document.createElement("div");
        el.innerHTML = html;
        var frag = document.createDocumentFragment(), node, lastNode;
        while ((node = el.firstChild)) {
            lastNode = frag.appendChild(node);
        }
        range.insertNode(frag);

    }



    ///======================== slug ========================
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\u0100-\uFFFF\w\-]/g, '-') // Remove all non-word chars ( fix for UTF-8 chars )
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }
    ///======================== slug ========================

</script>
<?= $this->endSection() ?>