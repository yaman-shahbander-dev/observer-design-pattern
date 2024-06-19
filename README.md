# Observer Design Pattern
## What is the Observer Design Pattern?

The Observer design pattern is a behavioral design pattern that allows objects to be notified when the state of another object changes. In this pattern, the subject (also known as the observable) maintains a list of its dependents, called observers, and notifies them automatically of any state changes, usually by calling one of their methods.

## Benefits of the Observer Design Pattern

The Observer design pattern provides the following benefits:

**1. Loose Coupling:** The subject and the observers have no direct dependency on each other. The subject only knows that it has attached observers, not their specific types.

**2. Flexibility:** New observers can be added and existing ones can be removed from the subject without affecting the subject or the other observers.

**3. Event-driven Architecture:** The Observer pattern allows for an event-driven architecture, where the subject can notify its observers whenever an interesting event occurs.

## Example Implementation

In this example, the **StockGrabber** class acts as the subject, maintaining a list of **StockObserver** objects (the observers). Whenever the stock prices for IBM, Apple, or Google change, the **StockGrabber** notifies all attached observers by calling their **update** method, which in turn updates the local stock price variables and prints the current prices.
