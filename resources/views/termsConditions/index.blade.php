@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
    <style>
        .terms-text ul li {
            padding-bottom: 8px;
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .terms-text ul li:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
    </style>
@endsection

{{-- Content --}}
@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	

    <!-- Terms and Conditions Section Start -->
    <div class="terms-conditions bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Terms Content Start -->
                    <div class="terms-content">
                        <div class="terms-text">
                            {{-- <h2>GoGlow - Conditions Générales d'Utilisation</h2> --}}
                            <p class="text-end">Dernière mise à jour : 24 juillet 2025</p>
                                                    <div class="section-title">
                                                        <h3 class="wow">Term & Conditions</h3>
                                                    </div>
                            
                            <h3>1. Introduction</h3>
                            <p>Les présentes Conditions Générales d'Utilisation régissent l'utilisation de l'application mobile GoGlow, exploitée par GoGlow, reliant les clients (Glowees) et les prestataires (Glowers) pour la réservation et la gestion de services de beauté. L'application est destinée aux utilisateurs en France, à Paris et dans l'UE et respecte le RGPD et la législation française sous la supervision de la CNIL.</p>
                            
                            <h3>2. Rôles des Utilisateurs</h3>
                            <ul>
                                <li>Clients (Glowees) : Parcourir, réserver et évaluer des services.</li>
                                <li>Prestataires (Glowers) : Enregistrer, proposer et gérer leurs services et réservations.</li>
                            </ul>
                            <br>
                            
                            <h3>3. Inscription et Compte</h3>
                            <p>Les utilisateurs peuvent s'inscrire via Google ou Apple (OAuth 2.0) ou manuellement avec prénom, nom, email, téléphone, adresse et mot de passe. Les utilisateurs doivent avoir 16 ans minimum. Les moins de 16 ans doivent fournir un consentement parental explicite à dpo@goglow.com. Les utilisateurs sont responsables de la confidentialité de leurs identifiants et de toute activité de leur compte.</p>
                            
                            <h3>4. Objet et Utilisation du Service</h3>
                            <p>L'application facilite la découverte, la réservation et la communication entre salons et clients. Elle n'est pas destinée à la promotion non sollicitée ni à un annuaire public sans consentement. GoGlow agit uniquement comme intermédiaire technique et n'est pas responsable de l'exécution ou de la qualité des services.</p>
                            
                            <h3>5. Paiements et Acompte</h3>
                            <p>Un acompte de 15 % est facturé lors de la réservation via Stripe (conforme PCI-DSS). Les informations de carte ne sont pas stockées. Les remboursements sont gérés entre le client et le prestataire selon la politique de ce dernier. GoGlow peut percevoir une commission pour les services de la plateforme.</p>
                            
                            <h3>6. Accès à la Localisation</h3>
                            <p>GoGlow demande l'accès à la localisation uniquement pour afficher les salons à proximité via l'API Google Maps. Les prestataires peuvent épingler l'adresse de leur salon. Les données de localisation ne sont pas conservées au-delà de cet usage et sont retenues 2 mois maximum.</p>
                            
                            <h3>7. Communication</h3>
                            <p>L'application permet une messagerie chiffrée entre clients et prestataires après réservation. Les numéros de téléphone ne sont partagés qu'après confirmation de réservation ou consentement explicite.</p>
                            
                            <h3>8. Notifications</h3>
                            <p>Des notifications push sont utilisées pour les réservations, les messages et les mises à jour. Les utilisateurs peuvent désactiver ces notifications dans les paramètres de leur appareil.</p>
                            
                            <h3>9. Utilisation Acceptable</h3>
                            <p>Les utilisateurs ne doivent pas :</p>
                            <ul>
                                <li>Se livrer à des activités abusives, harcelantes ou illégales</li>
                                <li>Publier du contenu offensant ou discriminatoire</li>
                                <li>Tenter d'accéder ou de modifier les services de l'application sans autorisation</li>
                                <li>Télécharger du contenu malveillant ou enfreindre la propriété intellectuelle</li>
                            </ul>
                            
                            <h3>10. Contenu et Propriété Intellectuelle</h3>
                            <p>Les utilisateurs peuvent publier des avis ou des photos et accordent à GoGlow une licence non exclusive et mondiale pour les afficher. Tous les éléments de l'application (textes, codes, marques) sont protégés par la propriété intellectuelle.</p>
                            
                            <h3>11. Suspension et Suppression de Compte</h3>
                            <p>GoGlow peut suspendre ou résilier des comptes en cas de violation des règles ou de comportement inapproprié. Les sanctions peuvent inclure avertissement, suspension temporaire ou suppression définitive. Les utilisateurs peuvent supprimer leur compte à tout moment ; toutes les données sont définitivement supprimées sous 30 jours.</p>
                            
                            <h3>12. Obligations des Prestataires</h3>
                            <p>Les Glowers doivent fournir des informations exactes et à jour, honorer les réservations acceptées et respecter la législation sur la protection des consommateurs.</p>
                            
                            <h3>13. Responsabilité</h3>
                            <p>GoGlow décline toute responsabilité concernant l'exécution des prestations, le contenu généré par les utilisateurs ou les liens externes. L'application est fournie « en l'état » sans garantie.</p>
                            
                            <h3>14. Liens Externes</h3>
                            <p>Des liens externes peuvent être présents à titre informatif. GoGlow n'est pas responsable de leur contenu ni de leurs pratiques.</p>
                            
                            <h3>15. Droit Applicable</h3>
                            <p>Les présentes CGU sont régies par le droit français. Tout litige relève de la compétence exclusive des tribunaux de Paris.</p>
                            
                            <h3>16. Contact</h3>
                            <p>Pour toute question : <a href="mailto:contact@goglow.com">contact@goglow.com</a></p>
                        </div>
                    </div>
                    <!-- Terms Content End -->
                </div>               
            </div>
        </div>
    </div>
    <!-- Terms and Conditions Section End -->

@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
