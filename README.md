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
Oprogramowanie potrzebne do włączenia projektu:
- docker
- docker-compose

UWAGA!
Poniższa konfiguracja działa tylko dla systemów z rodziny Linux.

Opis instalacji projektu:
1. Utworzyć folder z projektem.
2. W folderze projektu utworzyć folder “www” oraz “docker”.
2. Sklonować repozytorium do folderu “www”.
3. Skopiować zawartość folderu “projekt/www/docker” do folderu “projekt/docker”.
5. W pliku docker-compose.yml ustawić prawidłowe ścieżki dla plików konfiguracyjnych znajdujących się w folderze “projekt/docker” (plik docker-compose.yml sekcja volumes w konfiguracjach kontenerów “serwis_ogloszeniowy”, “apache_zdjecia”, “database”).
6. Z poziomu folderu “projekt/docker” w konsoli wpisać polecenie “docker-compose up”.
7. Poczekać aż obrazy dla kontenerów dockera się załadują.
8. Włączyć drugą konsolę I wpisać polecenie “docker exec -it serwis_ogloszeniowy bash”.
9. Wpisać polecenie “bin/console doctrine:migrations:migrate”.
10. Włączyć nową konsole I wpisać polecenie “docker exec -it apache_zdjecia bash”.
11. W tej samej konsoli wpisać “/etc/init.d/apache2 restart”.
12. Wejść dodać vhosta w głównym systemie. W przypadku ubuntu należy otworzyć plik  /etc/hosts z prawami administratora. W tym pliku należy dodać linijkę “127.0.0.1 serwis-ogloszeniowy.local”.

## Interfejs aplikacji
![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-44-48.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-45-04.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-45-18.png)


![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-45-46.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-46-03.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-46-58.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-47-34.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-48-21.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-48-37.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-44-48.png)
![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-47-49.png)

![](https://github.com/serwis-ogloszeniowy/serwis-ogloszeniowy/blob/master/doc_images/Screenshot%20from%202019-12-17%2012-48-01.png)


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

