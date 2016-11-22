<?php
namespace Common\ORG\Util;

class Calendar
{
    private $year;
    private $month;
    private $weeks  = array('日','一','二','三','四','五','六');
     
    function __construct($options = array()) {
        $this->year = date('Y');
        $this->month = date('m');
         
        $vars = get_class_vars(get_class($this));
        foreach ($options as $key=>$value) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $value;
            }
        }
    }
     
    function display1()
    {
        echo '<body bgcolor="#f3efef"><form><div id="bt"><span>广告排期</span></div>';
        echo '<table class="calendar">';
        $this->showChangeDate('搞笑头条');
        $this->showWeeks();
        $this->showDays($this->year,$this->month,1);
        echo '</table>';
    }

    function display2()
    {

        echo '<table class="calendar">';
        $this->showChangeDate('搞笑次条');
        $this->showWeeks();
        $this->showDays($this->year,$this->month,2);
        echo '</table>';
    }


    function display3()
    {

        echo '<table class="calendar">';
        $this->showChangeDate('大数据头条');
        $this->showWeeks();
        $this->showDays($this->year,$this->month,3);
        echo '</table>';
    }



    function display4()
    {

        echo '<table class="calendar">';
        $this->showChangeDate('大数据次条');
        $this->showWeeks();
        $this->showDays($this->year,$this->month,4);
        echo '</table>';
    }



    private function showWeeks()
    {
        echo '<tr>';
        foreach($this->weeks as $title)
        {
            echo '<th>'.$title.'</th>';
        }
        echo '</tr>';
    }
     
    private function showDays($year, $month,$t)
    {
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $starDay = date('w', $firstDay);
        $days = date('t', $firstDay);
 
        echo '<tr>';
        for ($i=0; $i<$starDay; $i++) {
            echo '<td>&nbsp;</td>';
        }
        for ($j=1; $j<=$days; $j++) {
            $i++;
            $stime=mktime(0,0,0,$month,$j,$year);
            $etime=mktime(0,0,0,$month,($j+1),$year);
            $where['strdate'] = array('ELT',$stime);
            $where['enddate'] = array('EGT',$etime);
            $where['status'] = $t;
            $rs= M('advert')->where($where)->find();
            if ($rs) {
                echo '<td class="today">'.$j.'</td>';
            } else {
                echo '<td>'.$j.'</td>';
            }
            if ($i % 7 == 0) {
                echo '</tr><tr>';
            }
            unset($where);
        }
         
        echo '</tr>';
    }
     
    private function showChangeDate($t)
    {
         
        $url = basename($_SERVER['PHP_SELF']);

        echo '<h5 style="text-align:center">'.$t.'</h5>';
        echo '<tr>';
    echo '<td ><a href="?'.$this->preYearUrl($this->year,$this->month).'">'.'<<'.'</a></td>';
    echo '<td ><a href="?'.$this->preMonthUrl($this->year,$this->month).'">'.'<'.'</a></td>';
        echo '<td colspan="3"><form>';
        echo '<select name="year" onchange="window.location=\''.$url.'?year=\'+this.options[selectedIndex].value+\'&month='.$this->month.'\'">';
        for($ye=1970; $ye<=2038; $ye++) {
            $selected = ($ye == $this->year) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$ye.'">'.$ye.'</option>';
        }
        echo '</select>';
        echo '<select name="month" onchange="window.location=\''.$url.'?year='.$this->year.'&month=\'+this.options[selectedIndex].value+\'\'">';
         
 
         
        for($mo=1; $mo<=12; $mo++) {
            $selected = ($mo == $this->month) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$mo.'">'.$mo.'</option>';
        }
        echo '</select>';        
        echo '</form></td>';        
    echo '<td><a href="?'.$this->nextMonthUrl($this->year,$this->month).'">'.'>'.'</a></td>';
    echo '<td><a href="?'.$this->nextYearUrl($this->year,$this->month).'">'.'>>'.'</a></td>';        
        echo '</tr>';
    }
     
    private function preYearUrl($year,$month)
    {
        $year = ($this->year <= 1970) ? 1970 : $year - 1 ;
         
        return 'year='.$year.'&month='.$month;
    }
     
    private function nextYearUrl($year,$month)
    {
        $year = ($year >= 2038)? 2038 : $year + 1;
         
        return 'year='.$year.'&month='.$month;
    }
     
    private function preMonthUrl($year,$month)
    {
        if ($month == 1) {
            $month = 12;
            $year = ($year <= 1970) ? 1970 : $year - 1 ;
        } else {
            $month--;
        }        
         
        return 'year='.$year.'&month='.$month;
    }
     
    private function nextMonthUrl($year,$month)
    {
        if ($month == 12) {
            $month = 1;
            $year = ($year >= 2038) ? 2038 : $year + 1;
        }else{
            $month++;
        }
        return 'year='.$year.'&month='.$month;
    }
     
}
?>