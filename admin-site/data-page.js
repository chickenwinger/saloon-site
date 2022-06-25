<script>
function closeForm<?php echo $row_product['productID']; ?>() {
    document.querySelector('#pop-up<?php echo $row_product['productID']; ?>').style.display = 'none';
}

function openForm<?php echo $row_product['productID']; ?>() {
    document.querySelector('#pop-up<?php echo $row_product['productID']; ?>').style.display = 'block';
}

$(function() {
    $("#show_more<?php echo $row_product['productID']; ?>").click(function() {
        $("#show_content<?php echo $row_product['productID']; ?>").css({
            "overflow": "visible",
            "white-space": "normal",
            "height": "auto"
        });
        $("#show_less<?php echo $row_product['productID']; ?>").css({
            "display": "block"
        });
        $("#show_more<?php echo $row_product['productID']; ?>").css({
            "display": "none"
        });
    });
    $("#show_less<?php echo $row_product['productID']; ?>").click(function() {
        $("#show_content<?php echo $row_product['productID']; ?>").css({
            "overflow": "hidden",
            "white-space": "nowrap",
            "text-overflow": "ellipsis",
        });
        $("#show_more<?php echo $row_product['productID']; ?>").css({
            "display": "block"
        });
        $("#show_less<?php echo $row_product['productID']; ?>").css({
            "display": "none"
        });
    });

    $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").click(function() {
        $("#show_content<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "overflow": "visible",
            "white-space": "normal",
            "height": "auto",
        });
        $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "display": "block"
        });
        $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "display": "none"
        });
    });
    $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").click(function() {
        $("#show_content<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "overflow": "hidden",
            "white-space": "nowrap",
            "text-overflow": "ellipsis",
        });
        $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "display": "block"
        });
        $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
            "display": "none"
        });
    });
});
</script>
