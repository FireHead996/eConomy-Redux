# eConomy-Redux
Polish version below / Polska wersja poniżej
UWAGA! Gra jest w trakcie produkcji. Jeżeli nie znasz się wystarczająco na programowaniu w PHP - odpuść sobie do czasu wyjścia wersji stabilnej bądź aż ktoś inny postawi bardziej kompletną wersję gry u siebie.

## **EN**



## **PL**

**eConomy Redux** to odnowiony silnik eConomy z użyciem framework'u Slim. Moim celem jest przepisanie go z przestarzałego, pełnego bugów kodu, na najnowszą wersję PHP, zgodnie z najlepszą znaną mi wiedzą.

Sam silnik eConomy to silnik strategicznej gry ekonomicznej via www napisany w PHP. W tej grze naszym celem jest rozwój naszej korporacji poprzez kupowanie nowych przedsiębiorstw i produkcję materiałów oraz późniejszą ich sprzedaż na giełdzie.

### **Instalacja**
#### Instrukcja dotyczy instalacji projektu na serwerze lokalnym.

1. Pobierz paczkę kodu z tego projektu i wypakuj ją w wybranym przez siebie miejscu.
2. Pobierz i zainstaluj [Composer](https://getcomposer.org/).
3. Otwórz konsolę systemu i przejdź do katalogu z wypakowanym kodem.
4. Wykonaj komendę `composer install`.
5. Poczekaj na pobranie zależności. W tym czasie możesz wykonać na swojej bazie danych plik .sql dołączony do plików projektu.
6. Przejdź do katalogu src i edytuj plik settings.php. Edytuj w nim dane dostępu do bazy danych (host, użytkownik, hasło, nazwa bazy danych).
7. Ustaw vHost na katalog public.
8. Wpisz w przeglądarce adres swojego vHost'a i ciesz się postawionym serwerem z grą. :)
