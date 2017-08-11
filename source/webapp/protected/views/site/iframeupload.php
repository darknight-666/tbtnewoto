<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script>
    $(function(){
        parent.iframeUpload('<?php echo $items['status']?>','<?php echo $items['url']?>','<?php echo $items['message']?>');
    });
</script>