import requests
from bs4 import BeautifulSoup
import pandas as pd
from collections import Counter
import re

url = "https://quotes.toscrape.com/"

response = requests.get(url)

if response.status_code == 200:

    soup = BeautifulSoup(response.text, "html.parser")

    quotes_data = []

    quotes = soup.find_all("div", class_="quote")

    for quote in quotes:

        text = quote.find("span", class_="text").get_text(strip=True)
        author = quote.find("small", class_="author").get_text(strip=True)

        tags = [
            tag.get_text(strip=True)
            for tag in quote.find_all("a", class_="tag")
        ]

        quotes_data.append({
            "Quote": text,
            "Author": author,
            "Tags": ", ".join(tags)
        })

    df = pd.DataFrame(quotes_data)

    print("\n========== SCRAPED DATA ==========\n")
    print(df.to_string(index=False))

    df.to_csv("scraped_quotes.csv", index=False)

    print("\n========== TOP AUTHORS ==========\n")
    author_frequency = df["Author"].value_counts()
    print(author_frequency.head(5))

    all_text = " ".join(df["Quote"]).lower()

    words = re.findall(r"\b[a-zA-Z]+\b", all_text)

    stop_words = {
        "the", "is", "a", "an", "and", "to", "of",
        "in", "it", "that", "for", "with", "as",
        "on", "be", "are", "was", "this", "i"
    }

    filtered_words = [
        word for word in words if word not in stop_words
    ]

    word_frequency = Counter(filtered_words)

    print("\n========== TOP KEYWORDS ==========\n")

    for word, count in word_frequency.most_common(10):
        print(f"{word}: {count}")

    print("\nScraping and analysis completed successfully!")
    print("Data saved in scraped_quotes.csv")

else:
    print("Failed to retrieve website.")
    print("Status Code:", response.status_code)