import json
import random
import requests
import os

def get_random_lorem():
    API_KEY = os.environ.get('NINJA_API_KEY')
    paragraphs = '1'
    api_url = 'https://api.api-ninjas.com/v1/loremipsum?paragraphs={}'.format(paragraphs)
    response = requests.get(api_url, headers={'X-Api-Key': API_KEY})
    res = "Lorem ipsum purus in mollis nunc sed id semper. Suspendisse faucibus interdum posuere lorem ipsum. Dictum non consectetur a erat"
    if response.status_code == requests.codes.ok:
        res = response.json()['text']
    return res

def get_random_image():
    try:
        response = requests.get("https://api.unsplash.com/photos/random?client_id=tE7UOZI-TDa9p_z6KPlwNVO9y58FkbkO3NJ3ivX10qE&query=cars")
        if response.status_code == 200:
            data = response.json()
            return data['urls']['regular']
        else:
            return "Image not found"
    except:
        return "Image not found"

car_types = ["sedan", "SUV", "wagon"]
brands = ["BMW", "Audi", "Ford", "Honda", "Mercedes", "Tesla"]
fuel_types = ["gasoline", "diesel", "electricity", "hydrogen"]
car_models = [
    "Fiesta", "Focus", "Mustang", "Civic", "Accord", "CR-V",
    "X5", "X3", "Veniera", "Optus", "Prime",
    "A4", "A6", "Q5", "Q7", "E-Class", "C-Class"
]

cars = []

for i in range(50):
    car = {
        "id": i,
        "type": random.choice(car_types),
        "brand": random.choice(brands),
        "model": random.choice(car_models),
        "image": get_random_image(),
        "mileage": random.randint(0, 200000),
        "fuel_type": random.choice(fuel_types),
        "seats": random.randint(4, 7),
        "quantity": random.randint(1, 10),
        "price_per_day": round(random.uniform(30, 299), 2),
        "description": get_random_lorem(),
        "available": True
    }
    car['search_index'] = f"{car['brand']} {car['model']} {car['type']} {car['fuel_type']}"
    car['search_index'] = car['search_index'].lower()
    car['name'] = f"{car['brand']} {car['type']} {car['model']}"
    cars.append(car)

# Set 5 random cars as not available
unavailable_cars = random.sample(cars, 5)
for car in unavailable_cars:
    car["available"] = False

file_path = 'public/json/cars.json'
with open(file_path, 'w') as f:
    json.dump(cars, f, indent=4)