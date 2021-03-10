<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="text-left">Дата добавления</td>
            <td class="text-left">Комментарий</td>
            <td class="text-left">Статус</td>
            <td class="text-left">Клиент уведомлен</td>
        </tr>
        </thead>
        <tbody>

        @foreach($order_history as $history)
            <tr>
                <td class="text-left">{{\Carbon\Carbon::parse($history['created_at'])->format('Y-m-d')}}</td>
                <td class="text-left">{{$history['comment']}}</td>
                <td class="text-left">{{$order_statuses[$history['status_id']]['name']}}</td>
                <td class="text-left">{{($history['notify'] == 1) ? "Да": "Нет"}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="history-pagination" style="margin: 0 auto;">
        {!! $order_history->appends(['id' => $id]) !!}
    </div>
</div>
