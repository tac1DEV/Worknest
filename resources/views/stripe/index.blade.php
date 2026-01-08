<!-- @session("success")
    <div>{{ $value }}</div>
@endsession -->
<!--<a href="{{ route('stripe.payment', ['price' => 100]) }}">Make Payment</a> Rendre dynamique (price)
<script>
    const data = JSON.parse(sessionStorage.getItem('stripeData'));
    if (!data) {
        console.error('Aucune donnée Stripe');
    } else {
        console.log(data);
    }
</script>
-->

<x-layouts.app :title="__('Récap')">

    <div class="flex justify-center items-center text-center">

        <div class="w-full max-w-2xl">

            <div class="px-6 py-4 border-b">
                <h1 class="text-xl font-semibold text-gray-800">
                    Récapitulatif de la réservation
                </h1>
            </div>

            <div id="recap-content" class="px-6 py-6 space-y-4 text-sm text-gray-700">
                <p class="text-gray-400">Chargement…</p>
            </div>

            <div class="px-6 py-4 border-t flex justify-end">
                <button id="pay-btn" class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    Procéder au paiement
                </button>
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const container = document.getElementById('recap-content');
            const payBtn = document.getElementById('pay-btn');

            const data = JSON.parse(sessionStorage.getItem('stripeData'));

            if (!data) {
                container.innerHTML = `
                    <p class="text-red-600">
                        Aucune donnée de commande trouvée.
                    </p>
                `;
                payBtn.disabled = true;
                return;
            }

            container.innerHTML = `
                <div class="flex justify-between">
                    <span class="font-medium">Nom de la réservation</span>
                    <span>${data.title}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium">Début</span>
                    <span>${data.start}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium">Fin</span>
                    <span>${data.end}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium">Espace réservé</span>
                    <span>${data.espace}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium">Prix</span>
                    <span>${data.prix} €</span>
                </div>
            `;

            payBtn.addEventListener('click', () => {

                const data = JSON.parse(sessionStorage.getItem('stripeData'));

                if (!data || !data.prix) {
                    alert('Prix introuvable !');
                    return;
                }
                window.location.href = `/stripe/payment?price=${data.prix}&title=${data.title}`;
            });

        });
    </script>
</x-layouts.app>