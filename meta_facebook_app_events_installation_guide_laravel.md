# Meta (Facebook) App Events – Laravel Implementation Guide

This document explains how to install and trigger **Meta (Facebook) App Events for Web** in the **Glaura Laravel project**. Please follow the steps carefully.

---

## Project Info

- **Framework:** Laravel (Web)
- **Platform:** Meta App Events (Web)
- **App ID:** `708204298568224`

The goal is to track user actions for ads performance, analytics, and audience targeting.

---

## STEP 1: Install Base App Events Code

### File to update
Add the base code in the **main layout file**, usually:

```
resources/views/layouts/app.blade.php
```
(or any global layout used across the site)

### Where to place
Inside the `<head>` tag.

### Code to add

```html
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');

  fbq('init', '708204298568224');
  fbq('track', 'PageView');
</script>

<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=708204298568224&ev=PageView&noscript=1"/>
</noscript>
```

---

## STEP 2: Required Events to Implement

Below are the events requested by the marketing team. Add them **only on relevant pages**.

---

### 1. Search Event

**Trigger on:** Search results page

```html
<script>
fbq('track', 'Search', {
  content_ids: ['search-keyword'],
  content_type: 'salon'
});
</script>
```

You may dynamically pass the search keywords. When someone search anything and click on the search button it event should trigger.

---

### 2. View Content

**Trigger on:** Service / product detail page

```html
<script>
fbq('track', 'ViewContent', {
  salon_ids: ['{{ $salon->id }}'],
  content_ids: ['{{ $service->id }}'],
  content_type: 'service'
});
</script>
```
when someone select the service (choose) or click on the choose button of the service , this event trigger.

---

### 3. Complete Registration

**Trigger on:** Signup success / thank-you page

```html
<script>
fbq('track', 'CompleteRegistration', {
  registration_method: 'email'
});
</script>
```
when someone is signup then this event is trigger.
---

### 4. Initiate Checkout

**Trigger on:** When user starts booking or checkout

```html
<script>
fbq('track', 'InitiateCheckout', {
  salon_ids: ['{{ $salon->id }}'],
  content_ids: ['{{ $service->id }}'],
  content_type: 'service',
  currency: 'EUR',
  value: {{ $price }}
});
</script>
```
When someone clicks the Book Appointment button, this event will be triggered regardless of whether the service price is paid or unpaid.
---

### 5. Purchase

**Trigger on:** Payment success / booking confirmation page

⚠️ IMPORTANT: Fire this event **only once**, after successful payment.

```html
<script>
fbq('track', 'Purchase', {
  salon_ids: ['{{ $salon->id }}'],
  content_ids: ['{{ $booking->id }}'],
  content_type: 'service',
  currency: 'EUR',
  value: {{ $booking->amount }}
});
</script>
```
this event is trigger after the successfull booking
---

## STEP 3: Verification

After implementation, verify events using:

- **Meta App Ads Helper**
- **App Event Tester**

Events should appear in **real time** when actions are performed.

---

## Important Notes

- Do NOT trigger events multiple times
- Do NOT fire Purchase before payment success
- Base code must be loaded globally
- Ensure currency and value are correct

---

## Reference Documentation

- Meta App Events (Web):
  https://developers.facebook.com/docs/app-events/getting-started-app-events-web#get-started---web

---

If anything is unclear, please ask before implementing changes.

