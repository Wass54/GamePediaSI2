Create table User (
    email VARCHAR(50),
    lastName VARCHAR(50),
    firstName VARCHAR(50),
    address VARCHAR(50),
    phoneNumber VARCHAR(10),
    dateOfBirth DATE,
    PRIMARY KEY (email)
);



Create table Comment(
    id int,
    title VARCHAR(50),
    content VARCHAR(500),
    createdAt DATETIME,
    updatedAt DATETIME,
    postedBy VARCHAR(50),
    game INT,
    PRIMARY KEY (id),
    FOREIGN KEY (game) references Game(id),
    FOREIGN KEY (postedBy) references User(email)
)