@extends('layouts.main')
{{-- Title --}}
@section('title', 'Privacy Policy')

{{-- Style Files --}}
@section('styles')

@endsection


{{-- Content --}}
@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Privacy Policy</span></h1>
                        {{-- <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                            </ol>
                        </nav> --}}
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	

    <!-- Privacy Policy Section Start -->
    <div class="privacy-policy bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Privacy Content Start -->
                    <div class="privacy-content">
                        <div class="privacy-text">
                            {{-- <h2>GoGlow - Politique de Confidentialité</h2> --}}
                            <p class="text-end">Dernière mise à jour : 24 juillet 2025</p>
                            
                            {{-- <h3>1. Responsable du Traitement</h3>
                            <p>[Nom de l'entreprise]<br>
                            [Adresse de l'entreprise, France/UE]<br>
                            Email : [Insérer l'email]<br>
                            Téléphone : [Insérer le numéro]<br>
                            Numéro SIRET : [Insérer le SIRET]</p> --}}
                            
                            <h3>1. Introduction</h3>
                            <p>GoGlow s'engage à protéger vos données personnelles conformément au RGPD et à la législation française sous la supervision de la CNIL. Cette politique s'applique à tous les utilisateurs âgés de 16 ans et plus. Les utilisateurs de moins de 16 ans doivent fournir un consentement parental explicite en contactant dpo@goglow.com.</p>
                            
                            <h3>2. Données Collectées</h3>
                            <ul>
                                <li><strong>Données d'identification :</strong> Nom, email (conservés pendant la durée du compte + 5 ans)</li>
                                <li><strong>Coordonnées :</strong> Numéro de téléphone (jusqu'à la suppression du compte)</li>
                                <li><strong>Données financières :</strong> Paiements (conservés pendant la transaction + 5–10 ans)</li>
                                <li><strong>Données de localisation :</strong> Localisation en temps réel pour afficher les salons proches (2 mois max)</li>
                                <li><strong>Historique et usage :</strong> Réservations, chat, notifications</li>
                                <li><strong>Données OAuth :</strong> Connexion sécurisée Google/Apple</li>
                                <li><strong>Journaux IP :</strong> 1 an</li>
                                <li><strong>Cookies :</strong> 13 mois max</li>
                                <li><strong>Consentement marketing :</strong> 3 ans après la dernière activité</li>
                                <li><strong>Enregistrements vocaux :</strong> 6 mois (5 ans pour appels contractuels)</li>
                            </ul>
                            
                            <h3>3. Finalités du Traitement</h3>
                            <p>Nous utilisons vos données pour :</p>
                            <ul>
                                <li>Gérer les comptes et réservations</li>
                                <li>Traiter les paiements via Stripe (conforme PCI-DSS)</li>
                                <li>Fournir la messagerie sécurisée et les notifications</li>
                                <li>Afficher des services basés sur la localisation via l'API Google Maps</li>
                                <li>Améliorer l'application et assurer son intégrité</li>
                                <li>Fournir un support client</li>
                                <li>Marketing avec consentement explicite</li>
                                <li>Respecter les obligations légales</li>
                            </ul>
                            
                            <h3>4. Bases Légales</h3>
                            <ul>
                                <li>Exécution contractuelle</li>
                                <li>Intérêt légitime</li>
                                <li>Consentement (localisation, marketing, partage de contact)</li>
                                <li>Obligation légale (conformité UE)</li>
                            </ul>
                            
                            <h3>5. Partage de Données</h3>
                            <p>Nous ne vendons ni ne partageons vos données avec des tiers. Nous utilisons :</p>
                            <ul>
                                <li>Stripe pour les paiements</li>
                                <li>API Google Maps pour la localisation</li>
                                <li>Firebase ou autres hébergements conformes RGPD</li>
                            </ul>
                            
                            <h3>6. Hébergement et Transferts</h3>
                            <p>Toutes les données sont hébergées dans l'UE. Les transferts hors UE utilisent des Clauses Contractuelles Types (SCC) pour garantir la conformité RGPD.</p>
                            
                            <h3>7. Sécurité des Données</h3>
                            <p>Nous appliquons le chiffrement, les protocoles HTTPS, des audits de sécurité réguliers, des tests d'intrusion, la traçabilité des accès et des politiques internes. Le personnel reçoit une formation régulière.</p>
                            
                            <h3>8. Droits des Utilisateurs (RGPD)</h3>
                            <p>Vous avez le droit d'accéder, de corriger, d'effacer, de limiter, de vous opposer au traitement, de demander la portabilité et de définir des directives post-mortem. Contact : <a href="mailto:dpo@goglow.com">dpo@goglow.com</a>. Une preuve d'identité peut être exigée.</p>
                            
                            <h3>9. Durée de Conservation</h3>
                            <p>Les données sont conservées uniquement le temps nécessaire aux finalités décrites. En cas de suppression du compte, toutes les données sont définitivement effacées sous 30 jours, sauf obligations légales.</p>
                            
                            <h3>10. Confidentialité des Enfants</h3>
                            <p>Notre application n'est pas destinée aux enfants de moins de 13 ans. Nous ne collectons pas sciemment leurs données. Les utilisateurs de moins de 16 ans doivent fournir un consentement parental.</p>
                            
                            <h3>11. Cookies</h3>
                            <p>Les cookies sont utilisés pour améliorer l'expérience utilisateur et sont conservés 13 mois maximum. Consultez notre Politique de Cookies pour plus de détails.</p>
                            
                            <h3>12. Plaintes et CNIL</h3>
                            <p>Pour toute préoccupation, contactez notre DPO à <a href="mailto:dpo@goglow.com">dpo@goglow.com</a> ou la CNIL :</p>
                            <p>Commission Nationale de l'Informatique et des Libertés (CNIL)<br>
                            3 place de Fontenoy – TSA 80751, 75334 Paris Cedex 07<br>
                            Téléphone : 01.53.73.22.22<br>
                            <a href="https://www.cnil.fr" target="_blank">https://www.cnil.fr</a></p>
                            
                            <h3>13. Modifications</h3>
                            <p>Nous pouvons mettre à jour cette Politique de Confidentialité pour refléter les évolutions légales ou de service. La date de la dernière révision sera toujours indiquée.</p>
                        </div>
                    </div>
                    <!-- Privacy Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Privacy Policy Section End -->

@endsection


{{-- Scripts --}}
@section('scripts')


@endsection