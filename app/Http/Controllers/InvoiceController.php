<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePdfMail;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        if (auth()->id() !== $invoice->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $invoice->load(['user', 'items', 'payment']);

        if (!$invoice->payment && $invoice->status === 'paid') {
            $invoice->payment = (object) [
                'transaction_id' => 'N/A',
                'paid_at' => $invoice->updated_at,
                'status' => 'completed',
            ];
        }

        return view('invoices.show', compact('invoice'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        if (auth()->id() !== $invoice->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $invoice->load(['user', 'items', 'payment']);
        
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        
        return $pdf->download("factura-{$invoice->invoice_number}.pdf");
    }

    public function sendEmail(Invoice $invoice)
    {
        if (auth()->id() !== $invoice->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $invoice->load(['user', 'items', 'payment']);
        
        Mail::to($invoice->user->email)
            ->send(new InvoicePdfMail($invoice));
            
        return back()->with('status', 'Factura enviada por correo electrónico correctamente');
    }
}