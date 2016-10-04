<div class="row">
<div class="col-sm-12 col-md-8 col-md-offset-2">
    <h1>Transaction History</h1>
    <table class="table">
          <thead>
            <tr>
                <th>Timestamp</th>
                <th>Name</th>
                <th>Symbol</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Transaction Price</th>
                <th>Total</th>
            </tr>
          </thead>
        <?php
    
            foreach ($transactions as $transaction)
            {
                print("<tr>");
                print("<td>" . $transaction["timestamp"] . "</td>");
                print("<td>" . $transaction["name"] . "</td>");
                print("<td>" . $transaction["symbol"] . "</td>");
                print("<td>" . $transaction["shares"] . "</td>");
                print("<td>" . $transaction["action"] . "</td>");
                print("<td>$ " . $transaction["price"] . "</td>");
                print("<td>$ " . $transaction["total"] . "</td>");
                print("</tr>");
            }
        ?>
    </table>
    
        <h1>Deposit History</h1>
    <table class="table">
          <thead>
            <tr>
                <th>Timestamp</th>
                <th>Amount</th>
            </tr>
          </thead>
        <?php
    
            foreach ($deposits as $deposit)
            {
                print("<tr>");
                print("<td>" . $deposit["timestamp"] . "</td>");
                   print("<td>$ " . $deposit["amount"] . "</td>");
                print("</tr>");
            }
        ?>
    </table>
</div>
</div>