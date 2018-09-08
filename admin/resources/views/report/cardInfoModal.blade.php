<table class="table table-bordered table-striped">
    @php($grandTotal=0)
    <thead>
        <th style="text-align: center">Card</th>
        <th style="text-align: center">Total</th>
    </thead>
    <tbody>
        @foreach($card as $c)
            <tr>
                <td>{{$c->cardBrand}}</td>
                <td>{{$c->total}}</td>
                @php($grandTotal+=$c->total)
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <td><b>Grand Total</b></td>
        <td><b>{{$grandTotal}}</b></td>
    </tfoot>


</table>