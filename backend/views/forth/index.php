<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 16/10/13
 * Time: 下午3:02
 */
$this->title = '微派融合计费';
$this->params['pagetitle']='微派融合计费';
$this->params['pageindex']=4;


?>

<div class="forth-index">
    <form name="form1" method="post" action="index.php?r=forth/index">
    <div class='' style="font-size:20px;">
        10元:
<!--        <hr />-->
        <p class='' style="font-size:15px;">
            移动:
            <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

                <?php for($i = 0; $i < count($result); $i++) {
                    $cotent = json_decode($result[$i]["content"],true);
                    if ($cotent==null) {
                        $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                    }
                    if ($cotent["1"]["10"]==1) {
                ?>
                    <input id=<?="ck1".$i ?>  type="checkbox" name="checkbox1[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                <?php }else { ?>
                    <input id=<?="ck1".$i ?>  type="checkbox" name="checkbox1[]" value=<?= $result[$i]["id"]; ?> />
                <?php } ?>

                    <label for=<?="ck1".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
                <?php } ?>
            </div>
        </p>
        <p class='' style="font-size:15px;">
            电信:
            <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

                <?php for($i = 0; $i < count($result); $i++) {
                    $cotent = json_decode($result[$i]["content"],true);
                    if ($cotent==null) {
                        $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                    }
                    if ($cotent["2"]["10"]==1) {
                        ?>
                        <input id=<?="ck2".$i ?> type="checkbox" name="checkbox2[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                    <?php }else { ?>
                        <input id=<?="ck2".$i ?> type="checkbox" name="checkbox2[]" value=<?= $result[$i]["id"]; ?> />
                    <?php } ?>

                    <label for=<?="ck2".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
                <?php } ?>
            </div>
        </p>
        <p class='' style="font-size:15px;">
            联通:
            <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

                <?php for($i = 0; $i < count($result); $i++) {
                    $cotent = json_decode($result[$i]["content"],true);
                    if ($cotent==null) {
                        $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                    }
                    if ($cotent["3"]["10"]==1) {
                        ?>
                        <input id=<?="ck3".$i ?> type="checkbox" name="checkbox3[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                    <?php }else { ?>
                        <input id=<?="ck3".$i ?> type="checkbox" name="checkbox3[]" value=<?= $result[$i]["id"]; ?> />
                    <?php } ?>

                    <label for=<?="ck3".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
                <?php } ?>
            </div>
        </p>
    </div>
    <hr />
    <div class='' style="font-size:20px;">
        20元:
<!--        <hr />-->
        <p class='' style="font-size:15px;">
            移动:
        <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

            <?php for($i = 0; $i < count($result); $i++) {
                $cotent = json_decode($result[$i]["content"],true);
                if ($cotent==null) {
                    $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                }
                if ($cotent["1"]["20"]==1) {
                    ?>
                    <input id=<?="ck4".$i ?>  type="checkbox" name="checkbox4[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                <?php }else { ?>
                    <input id=<?="ck4".$i ?> type="checkbox" name="checkbox4[]" value=<?= $result[$i]["id"]; ?> />
                <?php } ?>

                <label for=<?="ck4".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
            <?php } ?>
        </div>
        </p>
        <p class='' style="font-size:15px;">
            电信:
        <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

            <?php for($i = 0; $i < count($result); $i++) {
                $cotent = json_decode($result[$i]["content"],true);
                if ($cotent==null) {
                    $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                }
                if ($cotent["2"]["20"]==1) {
                    ?>
                    <input id=<?="ck5".$i ?> type="checkbox" name="checkbox5[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                <?php }else { ?>
                    <input id=<?="ck5".$i ?> type="checkbox" name="checkbox5[]" value=<?= $result[$i]["id"]; ?> />
                <?php } ?>

                <label for=<?="ck5".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
            <?php } ?>
        </div>
        </p>
        <p class='' style="font-size:15px;">
            联通:
        <div style="line-height:30px;background-color:#eeeeee;height:130px;width:960px;padding:0px;">

            <?php for($i = 0; $i < count($result); $i++) {
                $cotent = json_decode($result[$i]["content"],true);
                if ($cotent==null) {
                    $result[$i]["content"]='{"1":{"10":0,"20":0},"2":{"10":0,"20":0},"3":{"10":0,"20":0}}';
                }
                if ($cotent["3"]["20"]==1) {
                    ?>
                    <input id=<?="ck6".$i ?> type="checkbox" name="checkbox6[]" checked="checked" value=<?= $result[$i]["id"]; ?> />
                <?php }else { ?>
                    <input id=<?="ck6".$i ?> type="checkbox" name="checkbox6[]" value=<?= $result[$i]["id"]; ?> />
                <?php } ?>

                <label for=<?="ck6".$i ?> style="height:25px;width:70px"><?php echo $result[$i]["province"]?></label>
            <?php } ?>
        </div>
        </p>
    </div>

    <input type="submit" name="Submit" value="提交" style="height:35px;width:55px">
    </form>
</div>

