-- Inserimento dati per la tabella UTENTE
INSERT INTO UTENTE (Nome, Cognome, DataDiNascita, ImmagineProfilo, GruppoAppartenenza, Mail, Username, Password, Bio, Fazzolettone, Specialita, Totem)
VALUES 
  ('Giacomo', 'Foschi', '2002-03-02', 'img_giacomo.jpg', 'Cesena6', 'giakyfoschi@gmail.com', 'giaky_ilNano', 'password', 'Appassionato di outdoor,Insegnante di musica', 'fazzolettoneGiacomo.jpg', 'specialitàGiacomo.jpg', 'Dingo Loquace'),
  ('Giovanni', 'Rinchiuso', '2002-02-15', 'img_gino.jpg', 'Ravenna4', 'rinchiusog8@gmail.com', 'gino_ilGrande', 'password', 'Amante della cucina italiana', 'fazzolettoneGino.jpg', 'specialitàGino.jpg', 'Daino Pacifico'),
  ('Giovanni', 'Pisoni', '2002-05-30', 'img_haters.jpg', NULL, 'giovapison@gmail.com', 'piso_ilPacioccone', 'password', 'Io non volevo essere qui, mi hanno obbligato', NULL, NULL, NULL);

-- Inserimento dati per la tabella POST
INSERT INTO POST (IDPost, Testo, Immagine, Username, Data)
VALUES 
  (1, 'Accompagnando mia nonna ad attraversare la strada mi hanno dato una specialità, sono un bimbo bravo', 'img_specialità.jpg', 'giaky_ilNano', '2024-01-17'),
  (2, 'Organizzazione per il prossimo mese per Ravenna4', "img_organizzazione.jpg", 'gino_ilGrande', '2024-01-16'),
  (3, 'Come si esce da questo social?', NULL, 'piso_ilPacioccone', '2024-01-15');