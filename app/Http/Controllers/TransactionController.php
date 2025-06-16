<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $transactions = auth()->user()->transactions()->with(['book', 'user'])->get();
            return $this->sendResponse('Transactions retrieved successfully', 200, $transactions);
        } catch (\Exception $e) {
            return $this->sendError('Failed to retrieve transactions', 500, [$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'book_id' => 'required|exists:books,id',
                'total_amount' => 'required|numeric|min:0',
            ]);

            $unique_order_number = Transaction::where('user_id', $data['user_id'])
                ->where('book_id', $data['book_id'])
                ->count();

            $date = now()->format('Ymd');
            $increment_order_number = $unique_order_number + 1;

            $data['order_number'] = "ORD{$date}-{$increment_order_number}";

            $transaction = auth()->user()->transactions()->create($data);
            return $this->sendResponse('Transaction created successfully', 201, $transaction);
        } catch (\Exception $e) {
            return $this->sendError('Failed to create transaction', 500, [$e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $transaction = auth()->user()->transactions()->with(['book', 'user'])->findOrFail($id);
            return $this->sendResponse('Transaction retrieved successfully', 200, $transaction);
        } catch (\Exception $e) {
            return $this->sendError('Failed to retrieve transaction', 500, [$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $transaction = auth()->user()->transactions()->findOrFail($id);
            $transaction->delete();
            return $this->sendResponse('Transaction deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete transaction', 500, [$e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'book_id' => 'sometimes|exists:books,id',
                'total_amount' => 'sometimes|numeric|min:0',
            ]);

            $transaction = auth()->user()->transactions()->findOrFail($id);
            $transaction->update($data);
            return $this->sendResponse('Transaction updated successfully', 200, $transaction);
        } catch (\Exception $e) {
            return $this->sendError('Failed to update transaction', 500, [$e->getMessage()]);
        }
    }
}
