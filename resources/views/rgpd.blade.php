@if(!auth()->check())
  <x-layouts.anonyme :title="__('Worknest - Protection des données')">
    <main class="max-w-4xl mx-auto p-6 space-y-8">

      <header class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">RGPD : bases légales, durée conservation, droits utilisateurs</h1>
        <p class="text-sm text-gray-600 mt-1"><i>Date prise d'effet : 12 décembre 2025</i></p>
      </header>
      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 mb-4 text-indigo-600">1. Responsable du traitement</h2>
        <p class="mb-2">Le responsable du traitement des données à caractère personnel est :</p>
        <p class="font-semibold">Worknest</p>
        <p class="text-sm text-gray-600">
          Worknest – Société par actions simplifiée (SAS)<br />
          28 Place de la Bourse, Paris, 75002<br />
          Email : <a href="mailto:support@worknest.fr" class="text-indigo-500 hover:underline">support@worknest.fr</a>
        </p>
      </section>
      <section class="bg-white shadow rounded-lg p-6 space-y-4">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">2. Données collectées</h2>

        <div class="space-y-2">
          <h3 class="font-semibold text-lg">Données fournies directement par l'utilisateur</h3>
          <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>adresse e-mail</li>
            <li>nom et prénom</li>
            <li>adresse postale</li>
            <li>organisation</li>
            <li>identifiants de connexion (mot de passe)</li>
          </ul>
        </div>
        <div class="space-y-2">
          <h3 class="font-semibold text-lg">Données techniques</h3>
          <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>adresse IP</li>
            <li>données de connexion</li>
            <li>journaux techniques (logs)</li>
            <li>données de navigation</li>
          </ul>
        </div>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">3. Finalités du traitement</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>création et gestion des comptes utilisateurs</li>
          <li>authentification et sécurisation des accès</li>
          <li>réservation d’espaces</li>
          <li>gestion des paiements</li>
          <li>amélioration et maintenance de la plateforme</li>
          <li>détection d’anomalies et d’incidents de sécurité</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">4. Fondement juridique du traitement</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>l’exécution d’un contrat (création de compte, réservation, paiement)</li>
          <li>le respect d’obligations légales (facturation)</li>
          <li>l’intérêt légitime de Worknest (sécurité, amélioration du service)</li>
          <li>le consentement, lorsque requis (ex. cookies non essentiels)</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">5. Sécurité des données</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>les mots de passe sont hachés de manière irréversible</li>
          <li>données nécessaires à la logique métier chiffrées avant stockage</li>
          <li>communications protégées par des protocoles sécurisés</li>
          <li>SGBD avec journalisation des connexions et traçabilité des accès</li>
        </ul>
        <p class="mt-2 text-sm text-gray-600">Audits et réévaluations régulières seront mis en place à mesure de
          l’évolution de la plateforme.</p>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">6. Sous-traitants</h2>
        <p class="text-gray-700">Worknest peut faire appel à des sous-traitants :</p>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Stripe pour la gestion des paiements (tokenisation des données bancaires).</li>
        </ul>
        <p class="text-sm text-gray-600">Les sous-traitants n’agissent que sur instruction de Worknest et dans le respect
          du RGPD.</p>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">7. Conservation des données</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>données de compte : durée de vie du compte</li>
          <li>données de facturation : durée légale applicable</li>
          <li>données techniques : durée limitée à des fins de sécurité et d’analyse</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">8. Droits des utilisateurs</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>droit d’accès</li>
          <li>droit de rectification</li>
          <li>droit à l’effacement</li>
          <li>droit à la limitation</li>
          <li>droit d’opposition</li>
          <li>droit à la portabilité des données</li>
          <li>droit de retirer leur consentement à tout moment</li>
        </ul>
        <p>Toute demande peut être adressée à : <a href="mailto:support@worknest.fr"
            class="text-indigo-500 hover:underline">support@worknest.fr</a></p>
      </section>

      <section class="bg-white shadow rounded-lg p-6 text-gray-700">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">9. Modification de la politique</h2>
        <p>La présente politique de confidentialité peut être amenée à évoluer. Toute modification sera publiée sur cette
          page avec mise à jour de la date d’entrée en vigueur.</p>
      </section>

    </main>

  </x-layouts.anonyme>
@else
  <x-layouts.app :title="__('Worknest - Protection des données')">
    <main class="max-w-4xl mx-auto p-6 space-y-8">

      <header class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">RGPD : bases légales, durée conservation, droits utilisateurs</h1>
        <p class="text-sm text-gray-600 mt-1"><i>Date prise d'effet : 12 décembre 2025</i></p>
      </header>
      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 mb-4 text-indigo-600">1. Responsable du traitement</h2>
        <p class="mb-2">Le responsable du traitement des données à caractère personnel est :</p>
        <p class="font-semibold">Worknest</p>
        <p class="text-sm text-gray-600">
          Worknest – Société par actions simplifiée (SAS)<br />
          28 Place de la Bourse, Paris, 75002<br />
          Email : <a href="mailto:support@worknest.fr" class="text-indigo-500 hover:underline">support@worknest.fr</a>
        </p>
      </section>
      <section class="bg-white shadow rounded-lg p-6 space-y-4">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">2. Données collectées</h2>

        <div class="space-y-2">
          <h3 class="font-semibold text-lg">Données fournies directement par l'utilisateur</h3>
          <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>adresse e-mail</li>
            <li>nom et prénom</li>
            <li>adresse postale</li>
            <li>organisation</li>
            <li>identifiants de connexion (mot de passe)</li>
          </ul>
        </div>
        <div class="space-y-2">
          <h3 class="font-semibold text-lg">Données techniques</h3>
          <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>adresse IP</li>
            <li>données de connexion</li>
            <li>journaux techniques (logs)</li>
            <li>données de navigation</li>
          </ul>
        </div>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">3. Finalités du traitement</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>création et gestion des comptes utilisateurs</li>
          <li>authentification et sécurisation des accès</li>
          <li>réservation d’espaces</li>
          <li>gestion des paiements</li>
          <li>amélioration et maintenance de la plateforme</li>
          <li>détection d’anomalies et d’incidents de sécurité</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">4. Fondement juridique du traitement</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>l’exécution d’un contrat (création de compte, réservation, paiement)</li>
          <li>le respect d’obligations légales (facturation)</li>
          <li>l’intérêt légitime de Worknest (sécurité, amélioration du service)</li>
          <li>le consentement, lorsque requis (ex. cookies non essentiels)</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">5. Sécurité des données</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>les mots de passe sont hachés de manière irréversible</li>
          <li>données nécessaires à la logique métier chiffrées avant stockage</li>
          <li>communications protégées par des protocoles sécurisés</li>
          <li>SGBD avec journalisation des connexions et traçabilité des accès</li>
        </ul>
        <p class="mt-2 text-sm text-gray-600">Audits et réévaluations régulières seront mis en place à mesure de
          l’évolution de la plateforme.</p>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">6. Sous-traitants</h2>
        <p class="text-gray-700">Worknest peut faire appel à des sous-traitants :</p>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>Stripe pour la gestion des paiements (tokenisation des données bancaires).</li>
        </ul>
        <p class="text-sm text-gray-600">Les sous-traitants n’agissent que sur instruction de Worknest et dans le respect
          du RGPD.</p>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">7. Conservation des données</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>données de compte : durée de vie du compte</li>
          <li>données de facturation : durée légale applicable</li>
          <li>données techniques : durée limitée à des fins de sécurité et d’analyse</li>
        </ul>
      </section>

      <section class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">8. Droits des utilisateurs</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>droit d’accès</li>
          <li>droit de rectification</li>
          <li>droit à l’effacement</li>
          <li>droit à la limitation</li>
          <li>droit d’opposition</li>
          <li>droit à la portabilité des données</li>
          <li>droit de retirer leur consentement à tout moment</li>
        </ul>
        <p>Toute demande peut être adressée à : <a href="mailto:support@worknest.fr"
            class="text-indigo-500 hover:underline">support@worknest.fr</a></p>
      </section>

      <section class="bg-white shadow rounded-lg p-6 text-gray-700">
        <h2 class="text-2xl font-semibold border-b pb-2 text-indigo-600">9. Modification de la politique</h2>
        <p>La présente politique de confidentialité peut être amenée à évoluer. Toute modification sera publiée sur cette
          page avec mise à jour de la date d’entrée en vigueur.</p>
      </section>

    </main>

  </x-layouts.app>
@endif