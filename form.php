<?php
class Form
{
    private $fields = [];
    private $action;
    private $submit;
    private $jumField = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label)
    {
        $this->fields[$this->jumField]['name']  = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }

    public function displayForm()
    {
        echo "<form action='".$this->action."' method='POST'>";
        echo "<table width='100%' border='0'>";

        foreach ($this->fields as $f) {
            echo "<tr><td align='right'>{$f['label']}</td>";
            echo "<td><input type='text' name='{$f['name']}'></td></tr>";
        }

        echo "<tr><td colspan='2'><input type='submit' value='".$this->submit."'></td></tr>";
        echo "</table></form>";
    }
}
?>
