<h2>Installation</h2>

1. Start docker: <code>docker-compose up -d</code>;
2. Rename <b>.env.example</b> to <b>.env</b>;
3. Run <code>docker/php/install.sh</code>;
4. Enter in browser <b>http://localhost:8005</b>;

<h2>How add admin</h2>

1. Create user on page registration (http://localhost:8005/registration);
2. Open table <b>user</b> in database;
3. Insert to column <b>role</b> <code>["ROLE_USER", "ROLE_ADMIN"]</code>
