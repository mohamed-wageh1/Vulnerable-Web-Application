# Vulnerable Web Application – Patch & Remediation Report

## Author
**Mohamed Wageh Ibrahim Mohamed Attia Mattar**  
Cybersecurity Engineer

## Project Overview
This project is a deliberately vulnerable web application designed for learning and demonstrating real‑world web security vulnerabilities.  
The project lifecycle consists of four phases:

1. Application design and development  
2. Intentional vulnerability implementation  
3. Vulnerability discovery and exploitation  
4. **Patch, remediation, and secure re‑deployment (this phase)**

This report documents all discovered vulnerabilities, their security impact, and the remediation steps applied to produce the patched version of the application.

---

## Environment
- OS: Windows 10 (XAMPP)
- Web Server: Apache 2.4.58
- PHP: 8.0.30
- Database: MySQL
- Application Type: PHP-based Web Application

---

## Summary of Patched Vulnerabilities

| Vulnerability | Status |
|--------------|--------|
| SQL Injection | Fixed |
| Stored XSS | Fixed |
| Reflected XSS | Fixed |
| Broken Access Control | Fixed |
| IDOR | Fixed |
| CSRF | Fixed |
| Insecure File Upload | Fixed |
| Authentication Bypass | Fixed |

---

## 1. SQL Injection

### Vulnerable Code
```php
$query = "SELECT * FROM users WHERE username='$email' AND password='$password'";
mysqli_query($conn, $query);
```

### Impact
- Authentication bypass
- Credential disclosure
- Full database compromise

### Patch
- Migrated to PDO prepared statements
- Removed string concatenation

```php
$stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
$stmt->execute([$email]);
```

---

## 2. Stored Cross‑Site Scripting (XSS)

### Vulnerable Code
```php
<?= $msg['content'] ?>
```

### Impact
- Session hijacking
- Admin account compromise
- Persistent malicious payload execution

### Patch
- Output encoding using `htmlspecialchars()`
- Input sanitization

```php
<?= htmlspecialchars($msg['content'], ENT_QUOTES, 'UTF-8') ?>
```

---

## 3. Broken Access Control

### Vulnerable Behavior
- Admin pages accessible without role validation
- Message deletion accessible to non‑admins

### Impact
- Privilege escalation
- Unauthorized data manipulation

### Patch
```php
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied");
}
```

---

## 4. Insecure Direct Object Reference (IDOR)

### Vulnerable Code
```php
$id = $_GET['id'];
DELETE FROM messages WHERE id = $id;
```

### Impact
- Arbitrary data deletion
- Horizontal privilege escalation

### Patch
- Role checks
- Ownership validation
- Parameter casting

```php
$id = (int)$_POST['id'];
```

---

## 5. Cross‑Site Request Forgery (CSRF)

### Vulnerable Behavior
- Sensitive actions performed without CSRF tokens

### Impact
- Forced admin actions
- Account manipulation

### Patch
- CSRF token generation
- Token validation

```php
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
```

```php
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die("Invalid CSRF token");
}
```

---

## 6. Insecure File Upload

### Vulnerable Behavior
- Arbitrary file upload
- PHP web shell execution

### Impact
- Remote Code Execution (RCE)

### Patch
- Extension allow‑list
- Randomized file names
- Upload directory isolated from execution

```php
$allowed_ext = ['pdf', 'png', 'jpg', 'jpeg', 'docx'];
```

---

## 7. Authentication Hardening

### Improvements
- Password hashing (`password_hash` / `password_verify`)
- Account status checks
- Failed login tracking
- Session handling improvements

---

## Final Security State

| Area | Status |
|----|----|
| Authentication | Hardened |
| Authorization | Role‑based |
| Input Validation | Enforced |
| Output Encoding | Enforced |
| File Upload | Secured |
| CSRF Protection | Implemented |

---

## Conclusion
The patched version of the Vulnerable Web Application follows modern secure coding practices and mitigates all previously identified risks.

This project demonstrates:
- Secure PHP development
- Practical vulnerability remediation
- Defensive security mindset
- Real‑world penetration testing workflow

The patched application is suitable for portfolio demonstration and educational use.

---

## Disclaimer
This application is for **educational purposes only**.  
Do not deploy vulnerable versions in production environments.
