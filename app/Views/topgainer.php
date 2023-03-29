<h4>Top 5 Gainer
    <?= $exch ?>
</h4>
<div class="row">
    <div class="col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Script</th>
                    <th scope="col">Last</th>
                    <th scope="col">Prev. Close</th>
                    <th scope="col">Change (Rs.)</th>
                    <th scope="col">Change (%)</th>
                    <th scope="col">High</th>
                    <th scope="col">Low</th>
                    <?php
                    if ($exch != "BSE") {
                        echo "<th scope=\"col\">High 52 Week<br />High / Low</th>";
                    }
                    ?>
                    <th scope="col">Qty_Num</th>
                    <th scope="col">Value_Amt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td scope=\"col\">$row->Ticker</td>";
                        echo "<td scope=\"col\">$row->Last_Amt</td>";
                        echo "<td scope=\"col\">$row->Previous_Close_Amt</td>";
                        echo "<td scope=\"col\">$row->Change_Amt</td>";
                        echo "<td scope=\"col\">$row->Change_Pct</td>";
                        echo "<td scope=\"col\">$row->High_Amt</td>";
                        echo "<td scope=\"col\">$row->Low_Amt</td>";
                        if ($exch != "BSE") {
                            echo "<td scope=\"col\">$row->High_52_Week_Amt / $row->Low_52_Week_Amt</td>";
                        }
                        echo "<td scope=\"col\">$row->Qty_Num</td>";
                        echo "<td scope=\"col\">$row->Value_Amt</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan=\"10\"> no data to display</td></tr>";
                } ?>
            </tbody>

        </table>
    </div>
</div>