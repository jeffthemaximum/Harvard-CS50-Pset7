<table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    
    <tbody align="left">
        <?php foreach ($transactions as $transaction): ?>
            <tr>
            <td><?= $transaction["type"] ?></td>
            <td><?= $transaction["Date/Time"] ?></td>
            <td><?= $transaction["symbol"] ?></td>
            <td><?= $transaction["shares"] ?></td>
            <td><?= $transaction["price"] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
