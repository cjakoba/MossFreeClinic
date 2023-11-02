<?php
$websiteContent = file_get_contents('https://mossfreeclinic.org/?s');
echo $websiteContent;
?>

<script>
$(document).ready(function() {
    $('.main-content').load('view_em.html');
});
</script>


