# 🔧 Troubleshooting Guide

## Common Issues and Solutions

### Issue 1: Error on localhost:8000/register

**Problem:** You're trying to access `/register` directly in the browser.

**Solution:** 
- `/register` is an API endpoint, not a web page
- Go to: `http://localhost:8000/index.html` or just `http://localhost:8000`
- The web interface will handle registration for you

**Correct URLs:**
- ✅ `http://localhost:8000` - Main page (redirects to index.html)
- ✅ `http://localhost:8000/index.html` - Login/Register page
- ✅ `http://localhost:8000/contacts.html` - Contacts page
- ✅ `http://localhost:8000/test-api.html` - API test page
- ❌ `http://localhost:8000/register` - This is an API endpoint, not a page

---

### Issue 2: "Failed to fetch" or Network Error

**Possible Causes:**
1. Server is not running
2. Wrong URL
3. CORS issue

**Solutions:**

**Step 1: Check if server is running**
```bash
php artisan serve
```

You should see:
```
INFO  Server running on [http://127.0.0.1:8000]
```

**Step 2: Test the API**
Open: `http://localhost:8000/test-api.html`

This page will test your API and show you exactly what's wrong.

**Step 3: Check browser console**
- Press `F12` to open Developer Tools
- Go to "Console" tab
- Look for error messages
- Take a screenshot and check the error

---

### Issue 3: Registration/Login Not Working

**Check these:**

1. **Server is running**
   ```bash
   php artisan serve
   ```

2. **Database is migrated**
   ```bash
   php artisan migrate
   ```

3. **Use correct URL**
   - Go to: `http://localhost:8000/index.html`
   - NOT: `http://localhost:8000/register`

4. **Check form validation**
   - Name: Required
   - Email: Must be valid email format
   - Password: At least 8 characters
   - Confirm Password: Must match password

5. **Check browser console (F12)**
   - Look for JavaScript errors
   - Check Network tab for failed requests

---

### Issue 4: "Unauthenticated" Error

**Solution:**
1. Logout and login again
2. Clear browser cache (Ctrl+Shift+Delete)
3. Clear localStorage:
   - Press F12
   - Go to "Application" tab
   - Click "Local Storage"
   - Right-click and "Clear"
4. Register a new account

---

### Issue 5: Contacts Not Loading

**Solutions:**

1. **Check if logged in**
   - Make sure you're logged in
   - Check if token exists in localStorage (F12 → Application → Local Storage)

2. **Refresh the page**
   - Press F5 or Ctrl+R

3. **Check API response**
   - Press F12
   - Go to "Network" tab
   - Refresh page
   - Look for `/api/contacts` request
   - Check the response

---

### Issue 6: CORS Error

**Error message:** "Access to fetch at 'http://localhost:8000/api/...' from origin 'http://localhost:8000' has been blocked by CORS policy"

**Solution:**
This shouldn't happen since we configured CORS, but if it does:

1. Make sure you're accessing via `http://localhost:8000` (not file://)
2. Restart the server:
   ```bash
   # Press Ctrl+C to stop
   php artisan serve
   ```

---

### Issue 7: 404 Not Found

**If you get 404 on API endpoints:**

1. **Check routes are set up**
   ```bash
   php artisan route:list --path=api
   ```

2. **Clear route cache**
   ```bash
   php artisan route:clear
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Restart server**
   ```bash
   php artisan serve
   ```

---

### Issue 8: Database Errors

**Error:** "SQLSTATE[HY000]" or database connection errors

**Solutions:**

1. **Check .env file**
   - Make sure database settings are correct
   - Default is SQLite

2. **Run migrations**
   ```bash
   php artisan migrate
   ```

3. **Fresh migration (WARNING: Deletes all data)**
   ```bash
   php artisan migrate:fresh
   ```

---

## 🧪 Testing Steps

### Step-by-Step Test

1. **Start server**
   ```bash
   php artisan serve
   ```

2. **Test API**
   - Open: `http://localhost:8000/test-api.html`
   - Click "1. Test Server Connection"
   - Should show "✅ Server is running!"

3. **Test Registration**
   - Click "2. Test Register"
   - Should show "✅ Registration successful!"

4. **Open Web Interface**
   - Go to: `http://localhost:8000/index.html`
   - Try to register a new account

5. **Check Console**
   - Press F12
   - Look for any errors in Console tab

---

## 🔍 Debug Checklist

- [ ] Server is running (`php artisan serve`)
- [ ] Database is migrated (`php artisan migrate`)
- [ ] Using correct URL (`http://localhost:8000/index.html`)
- [ ] Browser console shows no errors (F12)
- [ ] Network tab shows successful API calls (F12)
- [ ] Token is stored in localStorage (F12 → Application)

---

## 📞 Getting More Help

### Check These Files:
1. **`START_HERE.md`** - Quick start guide
2. **`BROWSER_TESTING_GUIDE.md`** - Complete browser guide
3. **`API_DOCUMENTATION.md`** - API reference

### Use Test Page:
Open `http://localhost:8000/test-api.html` to test the API directly.

### Check Server Logs:
Look at the terminal where `php artisan serve` is running for error messages.

### Browser Developer Tools:
Press F12 and check:
- **Console** - JavaScript errors
- **Network** - API requests/responses
- **Application** - LocalStorage data

---

## 🎯 Quick Fixes

### Quick Fix 1: Fresh Start
```bash
# Stop server (Ctrl+C)
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan serve
```

### Quick Fix 2: Reset Database
```bash
php artisan migrate:fresh
```

### Quick Fix 3: Clear Browser
- Press Ctrl+Shift+Delete
- Clear cache and cookies
- Close and reopen browser

---

## ✅ Correct Usage

### DO:
- ✅ Go to `http://localhost:8000/index.html`
- ✅ Use the web interface to register/login
- ✅ Check browser console for errors
- ✅ Use test page to debug API

### DON'T:
- ❌ Go to `http://localhost:8000/register` directly
- ❌ Go to `http://localhost:8000/api/register` in browser
- ❌ Forget to start the server
- ❌ Ignore browser console errors

---

## 🚀 If All Else Fails

1. **Restart everything**
   ```bash
   # Stop server (Ctrl+C)
   php artisan config:clear
   php artisan route:clear
   php artisan cache:clear
   php artisan migrate:fresh
   php artisan serve
   ```

2. **Clear browser completely**
   - Close all browser windows
   - Clear all cache and cookies
   - Reopen browser

3. **Test with API test page**
   - Go to: `http://localhost:8000/test-api.html`
   - Run all tests
   - Check what fails

4. **Check the terminal**
   - Look at the output from `php artisan serve`
   - Any error messages there?

---

Need more help? Check the browser console (F12) and the server terminal for specific error messages!

