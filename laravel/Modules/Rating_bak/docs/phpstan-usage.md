# Utilizzo di PHPStan nel Progetto PTVX

## Esecuzione di PHPStan

PHPStan deve essere eseguito dalla directory principale di Laravel. Il comando corretto è:

```bash
cd /path/to/laravel
./vendor/bin/phpstan analyse -l 9 [percorso/al/modulo]
```

### Esempi di utilizzo

Analizzare un singolo modulo:
```bash
./vendor/bin/phpstan analyse -l 9 Modules/Rating
```

Analizzare più moduli contemporaneamente:
```bash
./vendor/bin/phpstan analyse -l 9 Modules/Rating Modules/User Modules/Notify
```

Analizzare tutti i moduli (attenzione, può richiedere tempo):
```bash
./vendor/bin/phpstan analyse -l 9 Modules/*
```

## Opzioni utili

- `-l 9` : imposta il livello di analisi a 9 (massimo)
- `--debug` : mostra ulteriori informazioni per il debugging
- `--memory-limit=2G` : imposta il limite di memoria per PHPStan (utile per progetti grandi)
- `--error-format=table` : formatta l'output come tabella
- `--no-progress` : disattiva la barra di progresso

## PHPStan e CI/CD

Quando si esegue PHPStan in un ambiente di CI/CD, è consigliabile utilizzare:

```bash
./vendor/bin/phpstan analyse -l 9 --no-progress --error-format=github Modules/*
```

## Architettura del Modulo Rating

L'efficacia dell'analisi statica tramite PHPStan nel modulo Rating dipende dalla corretta strutturazione sia del codice che delle directory.

### Organizzazione Concettuale del Modulo

Il modulo Rating è progettato secondo una separazione chiara tra:

* **Logica di business**: Classi che implementano la valutazione e il feedback degli utenti
* **Interfaccia utente**: Componenti Filament che consentono la gestione delle valutazioni
* **Servizi di supporto**: Utility e strumenti per l'elaborazione delle valutazioni

### Principi di Organizzazione dei File

**Principio fondamentale**: C'è una separazione tra struttura fisica e namespace logico.

#### Struttura delle Directory del Modulo Rating

* **Codice PHP**: Il codice PHP va nella directory `app/` e nei suoi sottomoduli logici
   ```
   Modules/Rating/app/Models/          <-- Modelli
   Modules/Rating/app/Actions/         <-- Operazioni (ex-Services)
   Modules/Rating/app/Filament/        <-- Interfacce amministrative
   ```

* **Traduzioni**: Risiedono direttamente nella directory `lang/` a livello root del modulo
   ```
   Modules/Rating/lang/it/            <-- Traduzioni italiane
   Modules/Rating/lang/en/            <-- Traduzioni inglesi
   ```

* **Configurazioni e Viste**: Nella directory root del modulo
   ```
   Modules/Rating/config/
   Modules/Rating/resources/views/
   ```

Per dettagli completi, consulta `docs/directory_structure.md`.

## Risoluzione dei problemi comuni

### "Impossibile trovare file"

Se PHPStan riporta "No files found to analyse", verificare:

1. Di essere nella directory `/path/to/laravel`
2. Che il percorso al modulo sia corretto
3. Che il modulo contenga effettivamente dei file PHP

### Errori di memoria

Se si verificano errori di memoria, aumentare il limite:

```bash
php -d memory_limit=2G ./vendor/bin/phpstan analyse -l 9 Modules/*
```

### Escludere file o directory

È possibile configurare esclusioni nel file `phpstan.neon`:

```yaml
parameters:
    excludePaths:
        - Modules/*/Tests/*
        - Modules/*/Vendor/*
```

## Configurazione avanzata

Il file `phpstan.neon` nella directory Laravel contiene le configurazioni personalizzate per il progetto.
