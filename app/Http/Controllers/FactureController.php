<?php

namespace App\Http\Controllers;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Schedule;
use Carbon\Carbon;

class FactureController extends Controller
{
    public function show($schedule)
    {
        $schedule = Schedule::findOrFail($schedule);
        $siren = fake()->siren();
        $numero_de_commande = rand(1000, 65000);
        $code = rand(10000000, 99000000);
        $datesDebut = Carbon::parse($schedule->start)->format('d/m/Y');
        $datesFin = Carbon::parse($schedule->end)->format('d/m/Y');
        $start = Carbon::parse($schedule->start)->startOfDay();
        $end = Carbon::parse($schedule->end)->startOfDay();
        $days = $start->diffInDays($end);

        $seller = new Party([
            'name' => 'Worknest',
            'phone' => '01 23 45 67 89',
            'custom_fields' => [
                'Siren' => $siren,
            ],
        ]);

        $customer = new Party([
            'name' => $schedule->user->name,
            'address' => '1 rue de la liberté',
            'code' => '#' . $code,
            'custom_fields' => [
                'Numero de commande' => $numero_de_commande,
            ],
        ]);

        $items = [
            InvoiceItem::make('Réservation du ' . $datesDebut . ' à ' . $datesFin . '.')
                ->description($schedule->title . ' - Espace ' . $schedule->espace->nom)
                ->pricePerUnit($schedule->espace->categorie->prix)
                ->quantity($days),
        ];

        $invoice = Invoice::make()
            ->series('BIG')
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($seller)
            ->buyer($customer)
            ->date(Carbon::now())
            ->dateFormat('d/m/Y')
            ->payUntilDays(14)
            ->currencySymbol('€')
            ->currencyCode('EUR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($seller->name . ' ' . $customer->name)
            ->addItems($items)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
    public function calculerPrix($schedule)
    {
        // Calculer la durée en jours
        $start = Carbon::parse($schedule->start)->startOfDay();
        $end = Carbon::parse($schedule->end)->startOfDay();
        $days = $start->diffInDays($end);

        // Prix basé sur la catégorie de l'espace
        $prixParJour = $schedule->espace->categorie->prix;
        $total = $days * $prixParJour;

        return $total;
    }
}