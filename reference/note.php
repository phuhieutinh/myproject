<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

<style>
    span.tag.label.label-info {
        /* Orange/$-Orange-300 */

        background: #FFAC6A;
        /* down */

        box-shadow: 0px 0px 6px #E7E9F2;
        border-radius: 9px;

        font-family: 'Nunito';
        font-style: normal;
        font-weight: 700;
        font-size: 25px;
        line-height: 19px;
        /* identical to box height */


        /* white */

        color: #FFFFFF;


        /* Inside auto layout */

        flex: none;
        order: 0;
        flex-grow: 0;
        margin: 0px 10px;
    }

    .bootstrap-tagsinput .tag [data-role="remove"] {
        content: url(../../picture/component/fi_xwhite.png);
        margin-left: 8px;
        cursor: pointer;
    }

    .bootstrap-tagsinput {
        position: absolute;
        width: 1125px;
        height: 81px;
        left: 0px;
        top: 25px;
    }

    form#addmonitor input {
        position: static;
        width: 200px;
        height: 44px;
        left: 0px;
        top: 32px;

        /* white */

        background: #FFFFFF;
        /* Gray/$-gray-100 */

        border: 1.5px solid #D4D4D7;
        box-sizing: border-box;
        border-radius: 8px;

        /* Inside auto layout */

        flex: none;
        order: 1;
        flex-grow: 0;
        margin: 8px 0px;
    }
</style>

<div id="tags">
    <input type="text" name="useservice" placeholder="Nhập dịch vụ sử dụng" class="useservice" data-role="tagsinput" id="tagsinput">
</div>

<script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
    });
</script>

<?php
if ($serviceName) {
    $array = explode(", ", $nameService);
    foreach ($array as $value) {
        if ($serviceName == $value) {
            $serviceName = null;
?>
            <option value="<?php echo ($array == "") ? "" : $array ?>" class="deco" disabled selected>
                <?php echo ($value == "") ? "" : $value ?>
            </option>
<?php
        }
    }
} ?>