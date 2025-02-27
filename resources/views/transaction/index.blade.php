@extends('layouts.app')
@section('title', 'Transactions - 7sebFlosk')

@section('content')
<div class="container">
    <h1>Transactions</h1>
    <a href="" class="btn btn-primary mb-3">Add New Transaction</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->description }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->category }}</td>
                <td>
                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
