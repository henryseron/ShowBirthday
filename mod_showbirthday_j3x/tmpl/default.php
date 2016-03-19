<?php
    defined('_JEXEC') or die('Restricted access');
    
    class ModShowBirthday{
        
        function get_birthdays($month, $format_date){
            $db = JFactory::getDbo(); 
            $query = $db->getQuery(true)
                    ->select($db->quoteName(array('up.profile_value', 'u.name')))
                    ->from($db->quoteName('#__user_profiles', 'up'))
                    ->join('LEFT', $db->quoteName('#__users', 'u').' ON '.$db->quoteName('u.id').' = '.$db->quoteName('up.user_id'))
                    ->where($db->quoteName('up.user_id').' >= 1000 AND '.$db->quoteName('up.profile_key').' = \'profile.dob\' AND '.
                            $db->quoteName('up.profile_value').' LIKE \'%-'.$month.'-%\'');
            $db->setQuery($query);
//            print $query.'<br>';
            $result = $db->loadObjectList();
//            print_r($result);
            $birthday = array();
            $pos = array('01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, 
                         '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0);
            foreach ($result as $i => $item) {
                $m = substr($item->profile_value, 6, 2);
                $d = substr($item->profile_value, 9, 2);
                $birthday['name'][$pos[$m]] = $item->name;
                // 1: DD/MM ; 2: MM/DD
                $birthday['date'][$pos[$m]] = (empty($format_date) || $format_date == 1) ? $d.'/'.$m : $m.'/'.$d;
                $pos[$m]++;
            }
            
            return $birthday;
        }
    }
       
    $doc = JFactory::getDocument();
    $doc->addStyleSheet(JURI::base().'modules/mod_showbirthday/assets/css/helium.css');
    $doc->addStyleSheet(JURI::base().'modules/mod_showbirthday/assets/css/style.css');
    $doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
    $doc->addScript(JURI::base().'modules/mod_showbirthday/assets/js/helium.modal.js');
    $doc->addScript(JURI::base().'modules/mod_showbirthday/assets/js/helium.mutate.js');
    $doc->addScript('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js');   
    
    $birthday = new ModShowBirthday();
    $b = $birthday->get_birthdays(date('m'), $format_date);
//    print_r($b);
?>
<div class="box">
    <table>
        <tbody>
            <?php for($i = 0; $i < count($b['name']) && substr($b['date'][$i], 3, 2) == date('m'); $i++): ?>
            <tr><td><?php echo $b['date'][$i]; ?></td><td><?php echo $b['name'][$i]; ?></td></tr>
            <?php endfor;?>
        </tbody>
    </table>
    <p><a href="" data-mid="modalid"><?php echo JText::_('MOD_SHOWBIRTHDAY_SHOWBIRTHDAY'); ?></a></p>
</div>
<div id="modalid" class="helium-modal">
        <div class="modal">
            <h1><!--span class="icon"><img src="images/birthday.png" width="19" alt="Cumpleaños" /></span--><?php echo JText::_('MOD_SHOWBIRTHDAY_BIRTHDAYS'); ?></h1>
            <table border="0" class="birthday">
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_JAN'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('01', $format_date);// January
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_FEB'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('02', $format_date);// February
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_MAR'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('03', $format_date);// March
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_APR'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('04', $format_date);// April
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_MAY'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('05', $format_date);// May
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_JUN'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('06', $format_date);// June
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_JUL'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('07', $format_date);// July
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_AUG'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('08', $format_date);// August
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_SEP'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('09', $format_date);// September
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_OCT'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('10', $format_date);// October
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_NOV'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('11', $format_date);// November
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                    <td>
                        <?php echo JText::_('MOD_SHOWBIRTHDAY_DEC'); ?><br>
                        <?php
                        $b = $birthday->get_birthdays('12', $format_date);// December
                        for($i = 0; $i < count($b['name']); $i++):
                            echo $b['date'][$i].' '.$b['name'][$i].'<br>';
                        endfor;
                        ?>
                    </td>
                </tr>
            </table>
        </div>
</div>
<script type="text/javascript" charset="utf-8">
$(function() {
    $(".helium-modal").each( function(){
        $(this).heliumModal({
            vert: 50,                // Vertical position on the screen in percentage.  50 centers the modal
            speed: 500,              // Speed for appearing and disapearing animations
            easing: 'swing',         // Easing style for animations.  use standard jquery easing options.
            onOpen: function(){ },   // callback for custom JS before modal opens
            afterOpen: function(){ },// callback for custom JS after modal opens
            onClose: function(){ },  // callback for custom JS before modal closes
            afterClose: function(){ }// callback for custom JS after modal closes
        });
    });
});
</script>