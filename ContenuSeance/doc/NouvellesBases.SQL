Create table User (
    email VARCHAR(100),
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
    created_at DATETIME,
    updated_at DATETIME,
    postedBy VARCHAR(100),
    game INT,
    PRIMARY KEY (id),
    FOREIGN KEY (game) references Game(id),
    FOREIGN KEY (postedBy) references User(email)
)