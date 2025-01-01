# Kalkulator Walutowy (Euro → PLN)

## Opis Projektu

Prosty kalkulator walutowy służący do przeliczania kwoty z Euro (EUR) na Polskie Złote (PLN). Projekt wykorzystuje dane o kursach walutowych dostarczane przez API Narodowego Banku Polskiego (NBP).

---

## Zawartość Repozytorium

- **`kurs-walut-v2.html`** - Główna strona aplikacji, zawierająca formularz do przeliczania walut oraz skrypt JavaScript obsługujący pobieranie danych z API i wyświetlanie wyniku.
- **`kalkulator-walutowy.php`** - Wtyczka WordPress dodająca funkcjonalność kalkulatora walutowego jako shortcode. Obsługuje dynamiczne przeliczanie walut z wykorzystaniem AJAX oraz API NBP. Kod zawiera mechanizmy buforowania danych, tłumaczeń oraz integracji z WordPress.

---

## Technologie

- **HTML5** - Struktura strony.
- **CSS3** - Stylizacja (można dodać osobny plik CSS w przyszłości).
- **JavaScript (ES6+)** - Obsługa dynamicznych operacji, przeliczenia oraz komunikacji z API.
- **PHP** - Kod wtyczki WordPress do obsługi AJAX i zarządzania danymi.
- **WordPress API** - Integracja z ekosystemem WordPress.
- **API Narodowego Banku Polskiego (NBP)** - Źródło danych kursu walutowego.

---

## Funkcjonalności

1. Wprowadzenie kwoty w Euro.
2. Kliknięcie przycisku 'Oblicz' w celu przeliczenia.
3. Automatyczne pobranie aktualnego kursu Euro z API NBP.
4. Wyświetlenie wyniku w formacie "X Euro = Y PLN".
5. Obsługa błędów w przypadku problemów z połączeniem z API.
6. Mechanizm buforowania kursu walutowego na godzinę w celu optymalizacji.
7. Wsparcie dla tłumaczeń i wielojęzyczności w WordPress.
8. Shortcode umożliwiający łatwą integrację z dowolną stroną WordPress.

---

## Jak uruchomić projekt?

1. **Krok 1:** Pobierz repozytorium lub sklonuj je na lokalną maszynę:
   ```bash
   git clone https://github.com/twoj-login/kalkulator-walutowy.git
   ```
2. **Krok 2:** Otwórz plik `kurs-walut-v2.html` w przeglądarce internetowej.
3. **Krok 3:** W przypadku WordPress zainstaluj i aktywuj wtyczkę `kalkulator-walutowy.php`.

---

## Przykład Użycia

1. Wprowadź kwotę w polu formularza.
2. Kliknij przycisk 'Oblicz'.
3. Otrzymasz wynik przeliczenia na podstawie aktualnego kursu Euro.
4. W WordPress użyj shortcode `[kalkulator_walutowy]` na dowolnej stronie lub wpisie.

---

## Wymagania

- Przeglądarka wspierająca JavaScript (Chrome, Firefox, Edge).
- Dostęp do internetu w celu pobrania kursu z API.
- WordPress 5.0 lub nowszy.

---

## Problemy i Sugestie

Jeżeli napotkasz problem lub masz sugestie dotyczące rozwoju aplikacji, utwórz nowe **Issue** na stronie repozytorium GitHub.

---

## Licencja

Projekt jest dostępny na licencji MIT. Szczegóły znajdują się w pliku `LICENSE`.

---

## Autor

**Xcope **

- GitHub: [https://github.com/xcope-dev]
- Email: r.lagooda@xcope.dev
