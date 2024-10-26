# Crypto Coins API

This is a simple API with prices for a list of crypto coins.

## Runing locally

### Requirements

In order to be able to run the project locally you need:
- Docker
- Docker Compose
- A Coingecko API Key

### Starting

From the project root folder:

 - Set your Coingecko Api-Key in the .env file in the "COINGECKO_API_KEY" key.
 - Execute:

```bash
docker compose up -d
```

### Using

You should be able to use the API now at the 8009 port (defined in the .env file).
So you can use the following endpoints:

#### Get all crypto coins

No parameters required, it lists all the available crypto coins in the API:

Ex:
[http://localhost:8009/api/v1/crypto-coins](http://localhost:8009/api/v1/crypto-coins)

#### Get most recent price

Returns the most recent price for the coin.

Required parameters:
 - coin

Ex: [http://localhost:8009/api/v1/crypto-coins/current-price?coin=btc](http://localhost:8009/api/v1/crypto-coins/current-price?coin=btc)

#### Get historical price

Returns the approximated price for the coin, at a given date/time.

Required parameters:
 - coin
 - datetime

[http://localhost:8009/api/v1/crypto-coins/historical-price?coin=eos&datetime=2024-10-26%2010:00:00](http://localhost:8009/api/v1/crypto-coins/historical-price?coin=eos&datetime=2024-10-26%2010:00:00)

#### Sync the prices

This endpoint fetches data from the Coingecko API and stores in the project database.
It should run hourly, every day, in a cronjob or similar mechanism.

[http://localhost:8009/api/v1/crypto-coins/sync-prices](http://localhost:8009/api/v1/crypto-coins/sync-prices)


## Demo

You can check this API working in the following endpoints:

[http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins](http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins)

[http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins/current-price?coin=btc](http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins/current-price?coin=btc)

[http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins/historical-price?coin=eos&datetime=2024-10-26%2010:00:00](http://ec2-44-211-129-219.compute-1.amazonaws.com/api/v1/crypto-coins/historical-price?coin=eos&datetime=2024-10-26%2010:00:00)

It's been running since 2024-10-26 18h UTC, so prices since this date only.

## License

[MIT](https://choosealicense.com/licenses/mit/)
