# Database Connection Fix Plan

## Issues Identified

1. **Wrong file extension**: `public/index.html` contains PHP code (`<?php ?>`) but has `.html` extension. Browsers won't execute PHP in `.html` files.

2. **Typo in include**: Line 1 says `include "idb.php"` instead of `include "db.php"`.

3. **Wrong relative paths in public/index.php**:
   - Form action: `includes/insert.php` → should be `../includes/insert.php`
   - Include: `includes/db.php` references from `public/` folder
   - Delete form action: `delete.php` → should be `../includes/delete.php`
   - Save update form action: `save_update.php` → should be `../includes/save_update.php`

4. **Wrong relative paths in includes/ files**:
   - `insert.php` does `include 'db.php'` (correct, same folder)
   - But redirects to `../index.html` → should be `../public/index.php`
   - `save_update.php` does `require 'includes/db.php'` → should be `require 'db.php'` (already in includes/)
   - `delete.php` does `require 'includes/db.php'` → should be `require 'db.php'` (already in includes/)

5. **MySQL port mismatch**: `db.php` uses port `3308`. Default XAMPP/WAMP port is `3306`. This will cause connection failure unless explicitly configured.

6. **Possible access method issue**: Opening file directly (`file://`) won't execute PHP. Must use local server (`http://localhost/...`).

## Proposed Fix Plan

### Step 1: Rename and fix public/index.html
- Rename `public/index.html` → `public/index.php`
- Fix `include "idb.php"` → `include "../includes/db.php"`
- Fix form action paths: `includes/insert.php` → `../includes/insert.php`
- Fix update section `require 'includes/db.php'` → `require '../includes/db.php'`
- Fix delete form action: `delete.php` → `../includes/delete.php`
- Fix save update form action: `save_update.php` → `../includes/save_update.php`

### Step 2: Fix includes/insert.php
- Fix redirect: `header("Location: ../index.html?status=success");` → `header("Location: ../public/index.php?status=success");`

### Step 3: Fix includes/save_update.php
- Fix require: `require 'includes/db.php';` → `require 'db.php';`

### Step 4: Fix includes/delete.php
- Fix require: `require 'includes/db.php';` → `require 'db.php';`

### Step 5: Fix MySQL port (if needed)
- Change `db.php` port from `3308` to `3306` if using default XAMPP/WAMP

### Step 6: Verify access method
- Ensure running via `http://localhost/FinalExamCode/public/index.php` not by opening file directly

## Dependent Files to Edit
- `public/index.html` (rename to `.php` and fix paths)
- `includes/insert.php`
- `includes/save_update.php`
- `includes/delete.php`
- `includes/db.php` (port only, if needed)

## Follow-up Steps
- Test database connection by visiting `http://localhost/FinalExamCode/public/index.php`
- Test CRUD operations (Create, Read, Update, Delete)

