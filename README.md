# Robinhood PHP SDK

This repository contains a PHP SDK for use with the
[Robinhood](https://robinhood.com/) trading API. This SDK was made possible
thanks to the extensive research done by [sanko](https://github.com/sanko/Robinhood).

**DISCLAIMER:** This is **NOT** an official SDK, it is not affiliated with nor
endorsed by Robinhood Markets, Inc. in any way. Use at your own risk.


## Installation

#### Via Composer

```shell
$ composer require jeffreyhyer/robinhood
```

Or add the following to your `composer.json` file:
```json
{
    "require": {
        "jeffreyhyer/robinhood": "~0.1.0"
    }
}
```

From within the same directory as your `composer.json` file execute:

```shell
$ composer install
```

In your PHP file (if you're not using a fancy framework that handles autoloading
for you):

```php
<?php

require './vendor/autoload.php';
```


## Usage

From within you PHP application you can access the Robinhood API with just a
couple lines:

```php
<?php

require './vendor/autoload.php';

// Authenticate with Username/Password
$username = "Username_123";
$password = "Password_456";
$account = "RobinhoodAccount#";
$token = "RobinhoodAuthToken";

$robinhood = new Robinhood\Robinhood($username, $password);
// OR
$robinhood = new Robinhood\Robinhood(null, null, $account, $token);

// Get the latest quote for Netflix (NFLX)
$orders = $robinhood->quotes->quote('NFLX');
```

## API

```php
$robinhood = new Robinhood\Robinhood($username, $password);
```


#### Authentication

Accessed via the `$robinhood->auth` or `$robinhood->authentication` properties.

- **Login**
    - `$robinhood->auth->login([bool $skipAccountId = false])`
        - If `$skipAccountId` is false (default) a second request will be made to
    get the account number of the primary account.

- **Logout**
    - `$robinhood->auth->logout()`
        - *Not Implemented*

- **Request Password Reset**
    - `$robinhood->auth->requestPasswordRest($email)`
        - *Not Implemented*

- **Reset Password**
    - `$robinhood->auth->resetPassword($resetToken)`
        - *Not Implemented*


#### Account

Accessed via the `$robinhood->accounts` or `$robinhood->account` properties.

- **List Accounts**
    - `$robinhood->accounts->accounts()`
        - List the available accounts

- **Get Account**
    - `$robinhood->accounts->account([string $account = ""])`
        - Get the account specified by the given `$account` number.
        - If `$account` is ommitted it will default to the current account

- **Get Portfolio**
    - `$robinhood->accounts->portfolio([string $account = ""])`
        - Get the portfolio for the given `$account` number.
            - If `$account` is ommitted it will default to the current account

- **Get All Positions**
    - `$robinhood->accounts->positions([string $account = "", [string $cursor = "", [string $nonzero = "true"]]])`
        - Get the positions for a given `$account` number starting at `$cursor` (page)
        - `$nonzero` can be one of [true, false, "" (empty string)]
            - If true, will return all positions that are nonzero
            - If false, will return all positions that are zero
            - If [blank], will return all positions

- **Get Single Position**
    - `$robinhood->accounts->position(string $position, [string $account = ""])`
        - `$position` is a string that contains the position ID to retrieve


#### Current User

Accessed via the `$robinhood->user` or `$robinhood->users` properties.

- **Current User**
    - `$robinhood->user->user()`

- **Current User's ID**
    - `$robinhood->user->userId()`

- **Basic Info**
    - `$robinhood->user->basicInfo()`

- **Investment Profile**
    - `$robinhood->user->investmentProfile()`

- **International Info**
    - `$robinhood->user->internationalInfo()`

- **Employment**
    - `$robinhood->user->employment()`

- **Additional Info**
    - `$robinhood->user->additionalInfo()`


#### ACH Relationships/Bank Accounts
Accessed via the `$robinhood->ach` or `$robinhood->wire` or `$robinhood->wires`
or `$robinhood->bank` or `$robinhood->banks` properties.

- **ACH Relationships**
    - `$robinhood->ach->accounts()`

- **Specific ACH Relationship**
    - `$robinhood->ach->account(string $id)`
        - The `$id` of the relationship to retrieve

- **Unlink ACH Relationship**
    - `$robinhood->ach->unlinkAccount(string $id)`
        - The `$id` of the relationship to unlink.
        - **Note:** Untested (hopefully for obvious reasons) so use at your own risk

- **Scheduled Deposits**
    - `$robinhood->ach->scheduledDeposits([string $cursor = ""])`
        - The `$cursor` at which to start (for paginated results)

- **Specific Scheduled Deposit**
    - `$robinhood->ach->scheduledDeposit(string $id)`
        - The `$id` of the scheduled deposit to retrieve details for

- **ACH Transfers**
    - `$robinhood->ach->transfers([string $cursor = ""])`
        - Retrieve the list of ACH/Bank transfers that have been executed

- **Specific ACH Transfer**
    - `$robinhood->ach->transfer($id)`
        - Retrieve the details of a specific transfer

- **Wire Relationships**
    - `$robinhood->wires->wires([string $cursor = ""])`

- **Specific Wire Relationship**
    - `$robinhood->wires->wire(string $id)`

- **Wire Transfers**
    - `$robinhood->wires->wireTransfers([string $cursor = ""])`

- **Specific Wire Transfer**
    - `$robinhood->wires->wireTransfer(string $id)`


#### Account Documents
Accessed via the `$robinhood->documents` or `$robinhood->document` properties.

- **Account Documents**
    - `$robinhood->documents->documents()`

- **Specific Document**
    - `$robinhood->documents->document(string $id)`

- **Download Specific Document File**
    - `$robinhood->documents->download(string $id)`
        - *Not Implemented*


#### Quotes
...


#### Instruments
...


#### Orders
...


#### Markets/Exchanges
...


#### Watchlists
...
