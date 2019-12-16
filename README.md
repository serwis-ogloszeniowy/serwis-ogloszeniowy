# Serwis ogłoszeniowy
Aplikacja pozwala na zamieszczenie własnego ogłoszenia odnośnie sprzedaży bądź usługi,
ponadto użytkownik może obejrzeć ogłoszenia innych użytkowników.

## Typy użytkowników i ich możliwośći:
- Użytkownik: 
  - Zamieszczenie nowego ogłoszenia
  - Przeglądanie obecnie aktywnych ogłoszeń
  - Edycja swoich ogłoszeń
- Administrator:
  - Zarządzanie kategoriami ogłoszeń
 
 
 ![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/1.PNG)

## Technologie wykorzystane w projekcie
- Aplikacja powstała w oparciu o następujące technologie:
  - PHP/Symfony - Strona backendowa
  - jQuery/Materialize - Strona frontendu
  - MySQL - Baza danych
  
### Rozwiązanie kwestii bezpieczeństwa aplikacji, przy dodawaniu zdjęć do ogłoszeń
W obawie o bezpieczeństwo aplikacji przed dodaniem nieporządanej treści w formie zdjęć (np. skrypt PHP), zastosowano kilka rozwiązań mające na celu poprawić ową sytuację:

Każde zdjęcie przed dodaniem podlega weryfikacji bazującej na jego rozszerzeniu. Gdy jest ono prawidłowe, plik wysyłany jest na osobny serwer. Serwer ten posiada tylko Apach'a odpowiedzialnego za hostowanie plików. Dzięki braku obecności PHP'a nie zostanie wykonany żadnen skrypt. Zdjęcia są hostowane w sposób statyczny.

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/3.PNG)

Powyższe rozwiązanie zostało zastosowane, ponieważ framework Symfony dysponuję wbudowanym mechanizmem walidacji zdjęć pozwalającą na sprawdzenie min.:
- rozmiaru
- rozszerzenia
- wagi obrazu

Jednakże wbudowane funkcje nie dają stuprocentowej pewności co do poprawności wrzucanego pliku.

**Walidacja pól**
W związku z niedoskonałością wbudowanych rozwiązań oferowanych przez framework Symfony, zastosowaliśmy własne walidatory do następujących pól:
- Imię i nazwisko
- adres e-mail - Adres musi zawierać znak '@'
- numer telefonu - Numer musi składać się z dziewięciu cyfr
## Instalacja projektu
## Schematy UML
### Diagram przypadków użycia:
![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/5.PNG)
### Schemat bazy danych:
![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/4.PNG)


## Wykonali:
- Mateusz Maciąg
- Sławomir Niedbała
- Dariusz Niemczycki

## License
This project is licensed under the MIT License - see the [MIT License](https://opensource.org/licenses/MIT) file for details.

