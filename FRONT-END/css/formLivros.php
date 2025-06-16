.form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container textarea { /* Added textarea for potentially longer descriptions */
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container textarea {
            resize: vertical;
            min-height: 80px;
        }
        .form-container .botoes {
            text-align: right;
            margin-top: 20px;
        }
        .form-container .botoes button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none; /* For the 'a' inside button */
            display: inline-block;
        }
        .form-container .botoes .cancelar {
            background-color: #6c757d;
            color: white;
            margin-right: 10px;
        }
        .form-container .botoes .cancelar a {
            color: white;
            text-decoration: none;
        }
        .form-container .botoes .confirmar {
            background-color: #007bff;
            color: white;
        }
        .form-container .botoes .confirmar a {
            color: white;
            text-decoration: none;
        }